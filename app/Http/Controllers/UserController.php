<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Corcel\Model\Post;
use App\Order;
use App\PartnerTransaction;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
    	$users = User::where('verified', 1)->paginate(10);
    	return view('admin.user.index', ['users' => $users]);
    }

    public function show($id) {
    	$user = User::find($id);
    	$type = DB::table('category')->find($user->type);
    	$currency = DB::table('currency')->find($user->currency);

        //get partner's product
        $products = Post::type('product')->hasMeta('_partner_id', $id)->orderBy('ID', 'desc')->paginate(5, ['*'], 'products');
        
        //get partner's order
        $all_products = Post::type('product')->hasMeta('_partner_id', $id)->orderBy('ID', 'desc')->get();
        $order_id = [];
        $deal_item = [];

        foreach ($all_products as $product) {
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
        $orders = Post::whereIn('ID', $order_id)->orderBy('ID', 'desc')->paginate(5, ['*'], 'orders');

        //get partner transaction
        $transactions = PartnerTransaction::where('partner_id', $id)->orderBy('id', 'desc')->paginate(5, ['*'], 'transactions');
        
    	return view('admin.user.show', ['user' => $user, 'currency' => $currency, 'type' => $type, 'products' => $products, 'orders' => $orders, 'transactions' => $transactions]);
    }

    public function edit($id) {
    	$user = User::find($id);
    	if($user->enable == 0) {
            // enable user
    		$user->enable = 1;
            // active all product
            Post::hasMeta('_partner_id', $id)->where('post_status', 'draft')->update(['post_status' => 'publish']);
    	} else {
            //disable user
            $user->enable = 0;
            // deactive all publish product
            Post::hasMeta('_partner_id', $id)->where('post_status', 'publish')->update(['post_status' => 'draft']);
        }
    	$user->save();
    	return redirect('/admin/users');
    }

    public function getProfile($id) {
    	$user = User::find($id);
    	$type = DB::table('category')->find($user->type);
    	$currency = DB::table('currency')->find($user->currency);
    	return view('profile', ['user' => $user, 'currency' => $currency, 'type' => $type]);
    }

    public function updateProfile($id,  Request $request) {
    	$user = User::find($id);
    	$user->update($request->all());
    	return redirect('/profile/'.$id);
    }

    public function destroy($id) {
    	$user = User::find($id);
    	$user->delete();
    	return redirect('/admin/users');
    }
}
