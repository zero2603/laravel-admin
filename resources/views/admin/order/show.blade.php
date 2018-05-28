@extends('master')

@section('title','Detail of Order')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.order.detail_title', ['id' => $order['id']])}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
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
		<h4>Check Status</h4>
		<ul>
			<li>Checked Partners: {{$orderStatus->checked_partners}}</li>
			<li>Checked Products: {{$orderStatus->checked_products}}</li>
		</ul>
	</div>

	<div class="col-md-12">
		<h4>{{__('content.order.list_items')}}</h4>
		<div><strong>{{__('content.order.message', ['count' => count($items)])}}</strong></div>
		@foreach($items as $key => $item)
			<h4><i>Deal {{$key+1}}</i></h4>
			@if($item['products'] != null)
			<table class="table">
				<thead>
					<tr>
						<th scope='col' width="20%">Product ID</th>
						<th scope='col' width="50%">{{__('content.order.product')}}</th>
						<th scope="col" width="10%">Partner ID</th>
						<th scope='col' width="20%">{{__('content.order.cost')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($item['products'] as $product)
					<tr>
						<td>{{$product['id']}}</td>
						<td>{{$product['name']}}</td>
						<td>{{$product['partner_id']}}</td>
						<td>{{$product['price']}}</td>
					</tr>
					@endforeach
					<tr>
						<th scope="row" colspan="3">{{__('content.order.total_label')}}</th>
						<td>{{$item['total'].' ✕ '.$item['quantity'].' = '. ($item['total']*$item['quantity'])}}</td>
					</tr>
				</tbody>
			</table>
			@endif
		@endforeach
	</div>
</div>

@endsection