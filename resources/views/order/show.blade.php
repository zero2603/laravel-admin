@extends('master')

@section('title','Detail of Order')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Detail of Order {{$order['id']}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="col-md-4">
	<h4>General Details</h4>

	<div class="form-group">
		<label>Order Date</label>
		<input type="text" readonly class="form-control" value="{{$order['date_modified_gmt']}}">
	</div>

	<div class="form-group">
		<label>Order Status</label>
		<input type="text" readonly class="form-control" value="{{$order['status']}}">
	</div>
</div>

<div class="col-md-4">
	<h4>Billing Details</h4>

	<div class="form-group">
		<label>Customer Name</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['first_name'].' '.$order['billing']['last_name']}}">
	</div>

	<div class="form-group">
		<label>Address</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['address_1'].' ,'.$order['billing']['address_2']}}">
	</div>

	<div class="form-group">
		<label>City</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['city']}}">
	</div>

	<div class="form-group">
		<label>State</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['state']}}">
	</div>

	<div class="form-group">
		<label>Country</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['country']}}">
	</div>

	<div class="form-group">
		<label>Email</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['email']}}">
	</div>

	<div class="form-group">
		<label>Phone</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['phone']}}">
	</div>
</div>

<div class="col-md-4">
	<h4>Payment Detail</h4>

	<div class="form-group">
		<label>Payment</label>
		<input type="text" readonly class="form-control" value="{{$order['payment_method_title']}}">
	</div>
</div>

<div class="col-md-12">
	<h4>List Item</h4>
	<div><strong>This order has {{count($items)}} deal(s)</strong></div>
	@foreach($items as $item)
	<table class="table">
		<thead>
			<tr>
				<th scope='col' width="50%">Product</th>
				<th scope='col'>Cost</th>
			</tr>
		</thead>
		<tbody>
			@foreach($item['products'] as $product)
			<tr>
				<td>{{$product['name']}}</td>
				<td>{{$product['price']}}</td>
			</tr>
			@endforeach
			<tr>
				<th scope="row">Total (price &#10005; quantity)</th>
				<td>{{$item['item_price'].' ✕ '.$item['quantity'].' = '.$item['total']}}</td>
			</tr>
		</tbody>
	</table>
	@endforeach
</div>

@endsection