<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Corcel\Model\Post;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request) {
    	$partner_id = Auth::id();
    	$keyword = $request->input('keyword');
    	$keyword = trim($keyword);

    	// keyword in product name
    	$resultProducts_1 = Post::type('product')->where('post_title', 'like', '%'.$keyword.'%')->hasMeta('_partner_id', $partner_id)->get();
    	// keyword in product description
    	$resultProducts_2 = Post::type('product')->where('post_content', 'like', '%'.$keyword.'%')->hasMeta('_partner_id', $partner_id)->get();

    	// get all orders has product above
    	$deal_item = [];
    	$order_id = [];
    	foreach ($resultProducts_1 as $product) {
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

		$orders = Post::type('shop_order')->whereIn('ID', $order_id)->get();

		return view('result', ['keyword' => $keyword, 'products_1' => $resultProducts_1, 'products_2' => $resultProducts_2, 'orders' => $orders]);
    }
}
