@extends('master')

@section('title','Detail of Order')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.order.detail.page_header', ['id' => $order['id']])}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-md-4">
		<h4>{{__('content.order.detail.header_1')}} </h4>

		<div class="form-group">
			<label>{{__('content.order.detail.label_1')}} </label>
			<input type="text" readonly class="form-control" value="{{$order['date_modified_gmt']}}">
		</div>

		<div class="form-group">
			<label>{{__('content.order.detail.label_2')}} </label>
			<input type="text" readonly class="form-control" value="{{$order['status']}}">
		</div>
	</div>

	<div class="col-md-4">
		<h4>{{__('content.order.detail.header_2')}}</h4>

		<div class="form-group">
			<label>{{__('content.order.detail.label_3')}}</label>
			<input type="text" readonly class="form-control" value="{{$order['billing']['first_name'].' '.$order['billing']['last_name']}}">
		</div>

		<div class="form-group">
			<label>{{__('content.order.detail.label_4')}}</label>
			<input type="text" readonly class="form-control" value="{{$order['billing']['address_1'].' ,'.$order['billing']['address_2']}}">
		</div>

		<div class="form-group">
			<label>{{__('content.order.detail.label_5')}}</label>
			<input type="text" readonly class="form-control" value="{{$order['billing']['city']}}">
		</div>

		<div class="form-group">
			<label>{{__('content.order.detail.label_6')}}</label>
			<input type="text" readonly class="form-control" value="{{$order['billing']['state']}}">
		</div>

		<div class="form-group">
			<label>{{__('content.order.detail.label_7')}}</label>
			<input type="text" readonly class="form-control" value="{{$order['billing']['country']}}">
		</div>

		<div class="form-group">
			<label>{{__('content.order.detail.label_8')}}</label>
			<input type="text" readonly class="form-control" value="{{$order['billing']['email']}}">
		</div>

		<div class="form-group">
			<label>{{__('content.order.detail.label_9')}}</label>
			<input type="text" readonly class="form-control" value="{{$order['billing']['phone']}}">
		</div>
	</div>

	<div class="col-md-4">
		<h4>{{__('content.order.detail.header_3')}}</h4>

		<div class="form-group">
			<label>{{__('content.order.detail.label_10')}}</label>
			<input type="text" readonly class="form-control" value="{{$order['payment_method_title']}}">
		</div>
	</div>

	<div class="col-md-12">
		<h4>{{__('content.order.detail.header_4')}}</h4>
		<div><strong>{{__('content.order.message_1', ['count' => count($items)])}}</strong></div>
		@foreach($items as $key => $item)
			<h4><i>Deal {{$key+1}}</i></h4>
			@if($item['products'] != null)
			<table class="table">
				<thead>
					<tr>
						<th scope='col' width="20%">{{__('content.order.detail.column_name_1')}}</th>
						<th scope='col' width="50%">{{__('content.order.detail.column_name_2')}}</th>
						<th scope='col' width="30%">{{__('content.order.detail.column_name_3')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($item['products'] as $product)
					<tr>
						<td>{{$product['id']}}</td>
						<td>{{$product['name']}}</td>
						<td>{{$product['price']}}</td>
					</tr>
					@endforeach
					<tr>
						<th scope="row" colspan="2">{{__('content.order.detail.total')}}</th>
						<td>{{$item['total'].' ✕ '.$item['quantity'].' = '. ($item['total']*$item['quantity'])}}</td>
					</tr>
				</tbody>
			</table>
			@else
			<div class="alert alert-danger">
				{{__('content.order.message_2')}}
			</div>
			@endif
		@endforeach
	</div>
</div>

@endsection