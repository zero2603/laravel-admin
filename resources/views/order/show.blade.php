@extends('master')

@section('title','Detail of Order')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.order.detail_title', ['id' => $order['id']])}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="col-md-4">
	<h4>{{__('content.order.general')}} </h4>

	<div class="form-group">
		<label>{{__('content.order.date')}} </label>
		<input type="text" readonly class="form-control" value="{{$order['date_modified_gmt']}}">
	</div>

	<div class="form-group">
		<label>{{__('content.order.status')}} </label>
		<input type="text" readonly class="form-control" value="{{$order['status']}}">
	</div>
</div>

<div class="col-md-4">
	<h4>{{__('content.order.billing')}}</h4>

	<div class="form-group">
		<label>{{__('content.order.name')}}</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['first_name'].' '.$order['billing']['last_name']}}">
	</div>

	<div class="form-group">
		<label>{{__('content.order.address')}}</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['address_1'].' ,'.$order['billing']['address_2']}}">
	</div>

	<div class="form-group">
		<label>{{__('content.order.city')}}</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['city']}}">
	</div>

	<div class="form-group">
		<label>{{__('content.order.state')}}</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['state']}}">
	</div>

	<div class="form-group">
		<label>{{__('content.order.country')}}</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['country']}}">
	</div>

	<div class="form-group">
		<label>{{__('content.order.email')}}</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['email']}}">
	</div>

	<div class="form-group">
		<label>{{__('content.order.phone')}}</label>
		<input type="text" readonly class="form-control" value="{{$order['billing']['phone']}}">
	</div>
</div>

<div class="col-md-4">
	<h4>{{__('content.order.payment')}}</h4>

	<div class="form-group">
		<label>{{__('content.order.method')}}</label>
		<input type="text" readonly class="form-control" value="{{$order['payment_method_title']}}">
	</div>
</div>

<div class="col-md-12">
	<h4>{{__('content.order.list_items')}}</h4>
	<div><strong>{{__('content.order.message', ['count' => count($items)])}}</strong></div>
	@foreach($items as $item)
	<table class="table">
		<thead>
			<tr>
				<th scope='col' width="50%">{{__('content.order.product')}}</th>
				<th scope='col'>{{__('content.order.cost')}}</th>
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
				<th scope="row">{{__('content.order.total_label')}}</th>
				<td>{{$item['item_price'].' ✕ '.$item['quantity'].' = '.$item['total']}}</td>
			</tr>
		</tbody>
	</table>
	@endforeach
</div>

@endsection