@extends('master')

@section('title','Search Results')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Search results for keyword "<i>{{$keyword}}</i>"</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<h2 class="page-header">Product has title like keyword</h2>
	<div class="col-lg-12">
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">{{__('content.products.ID')}}</th>
					<th scope="col">{{__('content.products.product_name')}}</th>
					<th scope="col">{{__('content.products.price')}}</th>
					<th scope="col">{{__('content.products.status')}}</th>
					<th scope="col">{{__('content.products.date')}}</th>
					<th scope="col" colspan="2">{{__('content.products.option')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products_1 as $product)
				<tr class="odd gradeX">
					<td>{{ $product->ID }}</td>
					<td>{{ $product->post_title }}</td>
					<td class="center">{{ $product->_regular_price }}</td>
					<td class="center">{{ $product->status }}</td>
					<td class="center">{{ $product->post_date }}</td>
					<td>
						<a href="{{action('ProductController@edit',$product->ID)}}"><button type="button" class="btn btn-primary btn-sm">{{__('content.products.edit')}}</button></a>
					</td>
					<td>
						<form action="{{action('ProductController@destroy', $product->ID)}}" method="POST">
							@csrf
							<input name="_method" type="hidden" value="DELETE">
							<button class="btn btn-danger btn-sm" type="submit">{{__('content.products.delete')}}</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<h2 class="page-header">Product has description like keyword</h2>
	<div class="col-lg-12">
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">{{__('content.products.ID')}}</th>
					<th scope="col">{{__('content.products.product_name')}}</th>
					<th scope="col">{{__('content.products.price')}}</th>
					<th scope="col">{{__('content.products.status')}}</th>
					<th scope="col">{{__('content.products.date')}}</th>
					<th scope="col" colspan="2">{{__('content.products.option')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products_2 as $product)
				<tr class="odd gradeX">
					<td>{{ $product->ID }}</td>
					<td>{{ $product->post_title }}</td>
					<td class="center">{{ $product->_regular_price }}</td>
					<td class="center">{{ $product->status }}</td>
					<td class="center">{{ $product->post_date }}</td>
					<td>
						<a href="{{action('ProductController@edit',$product->ID)}}"><button type="button" class="btn btn-primary btn-sm">{{__('content.products.edit')}}</button></a>
					</td>
					<td>
						<form action="{{action('ProductController@destroy', $product->ID)}}" method="POST">
							@csrf
							<input name="_method" type="hidden" value="DELETE">
							<button class="btn btn-danger btn-sm" type="submit">{{__('content.products.delete')}}</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<h2 class="page-header">Orders has product like keyword</h2>
	<div class="col-lg-12">
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">{{__('content.order.ID')}}</th>
					<th scope="col">{{__('content.order.status')}}</th>
					<th scope="col">{{__('content.order.order_by')}}</th>
					<th scope="col">{{__('content.order.date')}}</th>
					<th scope="col">{{__('content.order.total')}}</th>
					<th scope="col">{{__('content.order.option')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $order)
				<tr class="odd gradeX">
					<td>{{ $order->ID }}</td>
					<td>{{ explode('-', $order->post_status)[1] }}</td>
					<td>{{ $order->_billing_first_name }}&nbsp;{{ $order->_billing_last_name }}</td>
					<td class="center">{{ $order->post_date_gmt }}</td>
					<td class="center">{{ $order->_order_total }}</td>
					<td>
						<a href="{{action('OrderController@show', $order->ID)}}">
							<button class="btn btn-primary btn-sm">{{__('content.order.button_view')}}</button>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection