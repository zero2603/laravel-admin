<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Corcel\Model\Post;
use App\Order;
use App\PartnerTransaction;
use App\PartnerRecord;
use App\OrderStatus;
use Illuminate\Support\Facades\DB;
use Woocommerce;

class OrderController extends Controller
{
	private $SECRET_TOKEN = 'eatplaywatch123';
	
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
		// all completed orders
		$complete_order_id = PartnerRecord::where('partner_id', $partner_id)->get(['order_id'])->pluck('order_id')->toArray();

		switch ($request->status){
			case 'completed': {
				$orders = Post::whereIn('ID', $complete_order_id)->orderBy('ID', 'desc')->paginate(10);
				break;
			} 

			case 'processing': {
				$orders = Post::whereIn('ID', $order_id)->whereNotIn('ID', $complete_order_id)->where('post_status', 'wc-processing')->orderBy('ID', 'desc')->paginate(10);
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
			$total = 0;
			foreach ($deal['meta_data'] as $metadata) {
				if($metadata['key'] == 'deal') {
					$temp = explode('-', $metadata['value']);
					$listDealId = explode(',', $temp[0]);

					foreach($listDealId as $id) {
						$product = Woocommerce::get('products/'.$id);
						foreach ($product['meta_data'] as $metadata) {
							if($metadata['key'] == '_partner_id' && $metadata['value'] == Auth::id()){
								array_push($products, [
									'id' => $id,
									'name' => $product['name'],
									'price' => $product['price']
								]);
								$total += $product['price'];
							}
						}	
					}
					array_push($items, ['products' => $products, 'quantity' => $deal['quantity'],'total' => $total]);
				}
			}
		}
		return view('order.show', ['order' => $order, 'items' => $items]);
	}

	public function checkOrder(Request $request) {
		$current_order_id = $request->input('order_id');
		$order_secret_key = $request->input('order_secret_key');

		if($current_order_id != null && $order_secret_key != null) {
			if(strcmp($order_secret_key, md5($current_order_id.$this->SECRET_TOKEN)) == 0) {
				$partner_id = Auth::id();
				// get all product of partner 
				$products = DB::connection('wordpress')->select("select * from `wp_posts` where `post_type` = 'product' and exists (select * from `wp_postmeta` where `wp_posts`.`ID` = `post_id` and `meta_key` = '_partner_id' and `meta_value` = ?) order by `ID` asc", [$partner_id]);
				$order_id = []; // array of all partner's orders
				$deal_item = []; // items in deal/order
				// search all deal/order which includes partner's product 
				foreach ($products as $product) {
					$deals = DB::connection('wordpress')->select("select `order_item_id` from `wp_woocommerce_order_itemmeta` where `meta_key` = 'deal' and `meta_value` like ?", ['%'.$product->ID.'%']);
					foreach($deals as $deal) {
						if(!in_array($deal->order_item_id, $deal_item, true)) {
							array_push($deal_item, $deal->order_item_id);
						}
					}
				}
				// get all partner's order 
				$temps = Order::whereIn('order_item_id', $deal_item)->select('order_id')->get();
				foreach ($temps as $temp) {
					array_push($order_id, $temp->order_id);
				}
				
				// check current order is in partner's order list and it is processing
				if(in_array($current_order_id, $order_id)) {
					// get curent order
					$current_order = Woocommerce::get('orders/'.$current_order_id);
					
					if($current_order['status'] == 'completed') {
						$message = "This order had been already recorded for you.";
						$flag = 1;
					}
					else if($current_order['status'] == 'processing') {
						// find record if exist
						$records = DB::table('partner_records')->where('partner_id', $partner_id)->where('order_id', $current_order_id)->get();

						// if record not exist
						if(count($records) == 0) {
							// find all partner's products to get total price value in deal
							$total = 0;
							$interest = 0;
							$checked_products = []; // list checked product of current partner up to now
							$allProductsInOrder = []; // all product of multiple partner in this order 
							foreach ($current_order['line_items'] as $deal) {
								foreach ($deal['meta_data'] as $metadata) {
									if($metadata['key'] == 'deal') {
										$temp = explode('-', $metadata['value']);
										$listProductsId = explode(',', $temp[0]);
										// merge 2 array
										$allProductsInOrder = array_merge($allProductsInOrder, $listProductsId);
										$listProducts = Post::whereIn('ID', $listProductsId)->get();
										foreach ($listProducts as $product) {
											if($product->_partner_id == $partner_id) {
												$total += $product->_price_private_value;
												array_push($checked_products, $product->ID);
											}
											$interest += ($product->_price - $product->_price_private_value);
										}
									}
								}
							}

							$checked_products_string = implode(",", $checked_products);

							// create and store new record
							$record = new PartnerRecord([
								'partner_id' => $partner_id,
								'order_id' => $current_order_id,
								'value' => $total,
								'order_secret_key' => md5($current_order_id),
							]);
							$record->save();

							// plus money for partner
							$transaction = new PartnerTransaction([
								'partner_id' => $partner_id,
								'balance_change' => $total,
								'content' => 'From order #'.$current_order_id,
								'status' => 'completed'
							]);
							$transaction->save();

							// write data into order status table
							$orderStatus = OrderStatus::where('order_id', $current_order_id)->first();
							if($orderStatus != null) {
								// update
								$checked_partners = $orderStatus->checked_partners . ',' . $partner_id;
								// override checked products
								$checked_products_string = $orderStatus->checked_products . ',' . implode(",", $checked_products);
								
								// update order status
								$orderStatus->update(['checked_partners' => $checked_partners, 'checked_products' => $checked_products_string]);
							} else {
								// create new record in database
								$orderStatus = new OrderStatus ([
									'order_id' => $current_order_id,
									'order_total' => $current_order['total'],
									'interest' => $interest,
									'checked_partners' => $partner_id,
									'checked_products' => $checked_products_string,
									'status' => 'processing'
								]);
								$orderStatus->save();
							}

							// update order is complete
							if(array_diff($allProductsInOrder, explode(",", $checked_products_string)) == null) {
								Woocommerce::put('orders/'.$current_order_id, ['status' => 'completed']);
								$orderStatus->update(['status' => 'completed']);
							}

							$message = "Congratulate! You have just completed this order.";
							$flag = 1;

						} else {
							$message = "This order is completed.";
							$flag = 1;
						}
					} else {
						$message = "This order id is invalid. The order can be failed or refund.";
						$flag = 0;
					}
				} else {
					$message = "This order does not include your products or does not exist.";
					$flag = 0;
				}
			} else {
				$message = "Error! Secret key is not match.";
				$flag = 0;
			}	 
		} else {
			$message = "Order ID or Secure code is mising.";
			$flag = 0;
		}
		return view('check-order', ['message' => $message, 'flag' => $flag, 'order_id' => $current_order_id]);
	}

	public function destroy($id) {
		Post::find($id)->delete();
		return redirect()->back();
	}

	public function adminIndex() {
		$orders = Post::where('post_type', 'shop_order')->orderBy('ID', 'desc')->paginate(10);
		return view('admin.order.index', ['orders' => $orders]);
	}

	public function showInAdmin($id) {
		$order = Woocommerce::get('orders/'.$id);
		$orderStatus = OrderStatus::where('order_id', $id)->first();
		$items = [];
	
		foreach ($order['line_items'] as $deal) {
			$products = [];
			$total = 0;
			foreach ($deal['meta_data'] as $metadata) {
				if($metadata['key'] == 'deal') {
					$temp = explode('-', $metadata['value']);
					$listDealId = explode(',', $temp[0]);

					foreach($listDealId as $id) {
						$product = Woocommerce::get('products/'.$id);
						foreach ($product['meta_data'] as $metadata) {
							if($metadata['key'] == '_partner_id'){
								array_push($products, [
									'id' => $id,
									'name' => $product['name'],
									'price' => $product['price'],
									'partner_id' => $metadata['value']
								]);
								$total += $product['price'];
							}
						}	
					}
					array_push($items, ['products' => $products, 'quantity' => $deal['quantity'],'total' => $total]);
				}
			}
		}

		return view('admin.order.show', ['order' => $order, 'items' => $items, 'orderStatus' => $orderStatus]);
	}
}
