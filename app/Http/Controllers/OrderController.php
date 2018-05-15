<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Corcel\Model\Post;
use App\Order;
use Illuminate\Support\Facades\DB;
use Woocommerce;

class OrderController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(Request $request) {
		$partner_id = Auth::id();
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
		switch ($request->status){
			case 'completed': {
				$orders = Post::whereIn('ID', $order_id)->where('post_status', 'wc-completed')->orderBy('ID', 'desc')->paginate(10);
				break;
			} 
			
			case 'pending':
			case 'processing': {
				$orders = Post::whereIn('ID', $order_id)->where('post_status', 'wc-processing')->orderBy('ID', 'desc')->paginate(10);
				break;
			}

			case 'failed': {
				$orders = Post::whereIn('ID', $order_id)->whereIn('post_status', ['wc-cancelled', 'wc-refunded', 'wc-failed'])->orderBy('ID', 'desc')->paginate(10);
				break;
			}
			default: $order = null;
		}
		return view('order.index', ['orders' => $orders]);
	}

	public function show($id) {
		$order = Woocommerce::get('orders/'.$id);
		$items = [];
		foreach ($order['line_items'] as $deal) {
			$products = [];
			foreach ($deal['meta_data'] as $metadata) {
				if($metadata['key'] == 'deal') {
					$temp = explode('-', $metadata['value']);
					$listDealId = explode(',', $temp[0]);

					foreach($listDealId as $id) {
						$product = Woocommerce::get('products/'.$id);

						array_push($products, [
							'id' => $id,
							'name' => $product['name'],
							'price' => $product['price']
						]);
					}
					array_push($items, ['products' => $products, 'quantity' => $deal['quantity'], 'item_price' => $deal['price'],'total' => $deal['total']]);
				}
			}
		}
		return view('order.show', ['order' => $order, 'items' => $items]);
	}
}
