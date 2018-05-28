<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Corcel\Model\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\PartnerRecord;
use App\PartnerTransaction;
use App\Order;
use App\Annoucement;
use App\User;
use App\OrderStatus;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $partner_id = Auth::id();
        // display base month
        // get current month and year
        $month = date('m');
        $year = date('Y');

        if($request->has('month') && $request->has('year')) {
            $month = $request->input('month');
            $year = $request->input('year');
        }

        //complete order
        $completedOrders = PartnerRecord::where([['partner_id', '=', $partner_id], [DB::raw('month(updated_at)'), '=', $month], [DB::raw('year(updated_at)'), '=', $year]])->get();

        $complete_order_id = [];
        $totalAmount = 0;
        $numOfCompletedOrders = 0;
        foreach ($completedOrders as $order) {
            array_push($complete_order_id, $order->order_id);
            $numOfCompletedOrders++;
        }

        $amountThisMonth = PartnerTransaction::where([['partner_id', '=', $partner_id], ['status', '=', 'completed'], [DB::raw('month(updated_at)'), '=', $month], [DB::raw('year(updated_at)'), '=', $year]])->sum('balance_change');

        $products = Post::type('product')->select('ID')->where('post_status', 'publish')->hasMeta('_partner_id', $partner_id)->get();
        $order_id = [];
        $deal_item = [];

        // total products
        $numOfProducts = 0;

        foreach ($products as $product) {
            $numOfProducts++;

            $deals = DB::connection('wordpress')->select("select `order_item_id` from `wp_woocommerce_order_itemmeta` where `meta_key` = 'deal' and `meta_value` like ?", ['%'.$product->ID.'%']);
            foreach($deals as $deal) {
                if(!in_array($deal->order_item_id, $deal_item, true)) {
                    array_push($deal_item, $deal->order_item_id);
                }
            }
        }
        $temps = Order::whereIn('order_item_id', $deal_item)->select('order_id')->get();
        foreach ($temps as $temp) {
            array_push($order_id, $temp->order_id);
        }

        $not_complete_order = array_diff($order_id, $complete_order_id); // orders not complete

        $numOfProcessingOrders = Post::whereIn('ID', $not_complete_order)->where([['post_status', 'wc-processing'], [DB::raw('month(post_date_gmt)'), '=', $month], [DB::raw('year(post_date_gmt)'), '=', $year]])->count();

        // get all the time
        $all_completed_order = PartnerRecord::where('partner_id', $partner_id)->get(['order_id'])->pluck('order_id')->toArray();
        $allCompletedOrders = count($all_completed_order);
        $allProcessingOrders = Post::whereIn('ID', $order_id)->whereNotIn('ID', $all_completed_order)->where('post_status', 'wc-processing')->count();
        $allAvailableBalance = PartnerTransaction::where([['partner_id', '=', $partner_id], ['status', '=', 'completed']])->sum('balance_change');

        // get annoucement
        $annoucements = Annoucement::orderBy('id', 'desc')->paginate(5, ['*'], 'annoucements'); 

        return view('dashboard', ['numOfProducts' => $numOfProducts, 'numOfProcessingOrders' => $numOfProcessingOrders, 'numOfCompletedOrders' => $numOfCompletedOrders, 'amountThisMonth' => $amountThisMonth, 'monthValue' => $month, 'yearValue' => $year, 'allCompletedOrders' => $allCompletedOrders, 'allProcessingOrders' => $allProcessingOrders, 'allAvailableBalance' => $allAvailableBalance, 'annoucements' => $annoucements]);
    }

    public function adminDashboardAllTime() {
        // product
        $pendingProducts = Post::type('product')->where('post_status', 'pending')->count();
        $activeProducts = Post::type('product')->where('post_status', 'publish')->count();
        // partner
        $pendingPartners = User::where('enable', '0')->count();
        $activePartners = User::where('enable', '1')->count();

        $pendingOrders = Post::type('shop_order')->where('post_status', 'wc-processing')->count();

        $temp = OrderStatus::select(DB::raw('count(id) as quantity'), DB::raw('sum(order_total) as total'), DB::raw('sum(interest) as interestValue'))->get();
        $completedOrders = $temp[0]->quantity;
        $totalAmount = $temp[0]->total;
        $interest = $temp[0]->interestValue;

        $spent = PartnerRecord::sum('value');
        $debt = $totalAmount - $interest - $spent;

        $failedOrders = Post::type('shop_order')->whereIn('post_status', ['wc-canceled', 'wc-failed', 'wc-refunded'])->count();

        $totalWithdraw = PartnerTransaction::where('content', 'withdraw')->sum('balance_change');

        return view('admin.dashboard', ['pendingProducts' => $pendingProducts, 'activeProducts' => $activeProducts, 'pendingPartners' => $pendingPartners, 'activePartners' =>  $activePartners, 'pendingOrders' => $pendingOrders, 'completedOrders' => $completedOrders, 'failedOrders' => $failedOrders,'totalAmount' => $totalAmount, 'spent' => $spent, 'interest' => $interest, 'debt' => $debt, 'totalWithdraw' => $totalWithdraw]);
    }

    public function adminDashboardInMonth(Request $request) {
        // define month and year
        $month = date('m');
        $year = date('Y');

        if($request->has('month') && $request->has('year')) {
            $month = $request->input('month');
            $year = $request->input('year');
        }

        $pendingOrders = Post::type('shop_order')->where([['post_status', 'wc-processing'], [DB::raw('month(post_date_gmt)'), '=', $month], [DB::raw('year(post_date_gmt)'), '=', $year]])->count(); 

        $temp = OrderStatus::select(DB::raw('count(id) as quantity'), DB::raw('sum(order_total) as total'), DB::raw('sum(interest) as interestValue'))->where([['status', 'completed'], [DB::raw('month(updated_at)'), '=', $month], [DB::raw('year(updated_at)'), '=', $year]])->get();
        $completedOrders = $temp[0]->quantity;
        $totalAmount = $temp[0]->total;
        $interest = $temp[0]->interestValue;

        $failedOrders = Post::type('shop_order')->whereIn('post_status', ['wc-canceled', 'wc-failed', 'wc-refunded'])->where([[DB::raw('month(post_date_gmt)'), '=', $month], [DB::raw('year(post_date_gmt)'), '=', $year]])->count();

        $spent = PartnerRecord::where([[DB::raw('month(updated_at)'), '=', $month], [DB::raw('year(updated_at)'), '=', $year]])->sum('value');
        $debt = $totalAmount - $interest - $spent;

        $totalWithdraw = PartnerTransaction::where([['content', 'withdraw'], [DB::raw('month(updated_at)'), '=', $month], [DB::raw('year(updated_at)'), '=', $year]])->sum('balance_change');

        $chartData = OrderStatus::select(DB::raw('count(id) as quantity'), DB::raw('sum(order_total) as total'), DB::raw('sum(interest) as interestValue'), DB::raw('day(updated_at) as day'))->where([[DB::raw('month(updated_at)'), '=', $month], [DB::raw('year(updated_at)'), '=', $year]])->groupBy('day')->orderBy('day', 'asc')->get();

        return view('admin.month', ['pendingOrders' => $pendingOrders, 'completedOrders' => $completedOrders, 'failedOrders' => $failedOrders,'totalAmount' => $totalAmount, 'spent' => $spent, 'debt' => $debt, 'interest' => $interest, 'totalWithdraw' => $totalWithdraw, 'monthValue' => $month, 'yearValue' => $year, 'chartData' => $chartData]);
    }
}
