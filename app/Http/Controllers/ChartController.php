<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Corcel\Model\Post;
use App\Order;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index(Request $request) {
    	$partner_id = 1;
		$products = Post::type('product')->hasMeta('_partner_id', $partner_id)->orderBy('ID')->get();
		$order_id = [];
		$deal_item = [];

		foreach ($products as $product) {
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

		$orders = [];
		$orders = Post::select(DB::raw('day(post_date_gmt) as day'), DB::raw('count(date(post_date_gmt)) as count'))->whereIn('ID', [1252, 1253, 1254, 1255])->where([['post_status', '=', 'wc-completed'], [DB::raw('month(post_date_gmt)'), '=', $request->input('month')], [DB::raw('year(post_date_gmt)'), '=', $request->input('year')]])->groupBy('day')->get();

		return view('chart', ['orders' => $orders]);
    }
}