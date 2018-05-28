@extends('master')

@section('title','All Partners')

@section('content')

<div class="row" display:inline>
	<div class="col-lg-8">
		<h1 class="page-header" style="display: inline-block;">{{__('admin.user.title_2', ['id' => $user->id])}}</h1>

	</div>
	<div class="col-lg-4 custom-button">
		<div class="col-lg-4">
			@if($user->enable == 0)
			<a href="{{action('UserController@edit', $user->id)}}"><button type="button" class="btn btn-success btn-lg">{{__('admin.user.btn_2')}}</button></a>
			@else 
			<a href="{{action('UserController@edit', $user->id)}}"><button type="button" class="btn btn-warning btn-lg">{{__('admin.user.btn_3')}}</button></a>
			@endif	
		</div>
		<div class="col-lg-4">
			<form action="{{action('UserController@destroy', $user->id)}}" method="POST">
				@csrf
				<input name="_method" type="hidden" value="DELETE">
				<button class="btn btn-danger btn-lg" type="submit">{{__('admin.user.btn_4')}}</button>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<h4>{{__('admin.user.show_title_1')}}</h4>
		<div class="form-group">
			<label>{{__('admin.user.name')}}</label>
			<input type="text" readonly class="form-control" value="{{$user->name}}">
		</div>
		<div class="form-group">
			<label>{{__('admin.user.email')}}</label>
			<input type="text" readonly class="form-control" value="{{$user->email}}">
		</div>
		<div class="form-group">
			<label>{{__('admin.user.address')}}</label>
			<input type="text" readonly class="form-control" value="{{$user->address}}">
		</div>
		<div class="form-group">
			<label>{{__('admin.user.country')}}</label>
			<input type="text" readonly class="form-control" value="{{$user->country}}">
		</div>
		<div class="form-group">
			<label>{{__('admin.user.phone')}}</label>
			<input type="text" readonly class="form-control" value="{{$user->phone}}">
		</div>
		<div class="form-group">
			<label>{{__('admin.user.tax')}}</label>
			<input type="text" readonly class="form-control" value="{{$user->tax}}">
		</div>
	</div>
	<div class="col-md-6">
		<h4>{{__('admin.user.show_title_2')}}</h4>
		<div class="form-group">
			<label>{{__('admin.user.restaurent_name')}}</label>
			<input type="text" readonly class="form-control" value="{{$user->restaurent_name}}">
		</div>
		<div class="form-group">
			<label>{{__('admin.user.website')}}</label>
			<input type="text" readonly class="form-control" value="{{$user->website}}">
		</div>
		<div class="form-group">
			<label>{{__('admin.user.type')}}</label>
			<input type="text" readonly class="form-control" value="{{$type->name}}">
		</div>
		<div class="form-group">
			<label>{{__('admin.user.currency')}}</label>
			<input type="text" readonly class="form-control" value="{{$currency->symbol}}">
		</div>
	</div>

	<div class="col-md-12">

	</div>

	<div class="col-lg-12">
		<hr>
		<h2 class="page-header">All Products</h2>
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Product Name</th>
					<th scope="col">Price</th>
					<th scope="col">Private price</th>
					<th scope="col">Status</th>
					<th scope="col">Post date</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
				<tr class="odd gradeX">
					<td>{{ $product->ID }}</td>
					<td>{{ $product->post_title }}</td>
					<td>{{ $product->_regular_price }}</td>
					<td>{{ $product->_price_private_value }}</td>
					<td>{{ $product->post_status }}</td>
					<td>{{ $product->post_date }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div>
			{{ $products->appends(['sort' => 'ID'])->links() }}
		</div>
	</div>

	<div class="col-lg-12">
		<hr>
		<h2 class="page-header">All Orders</h2>
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Status</th>
					<th scope="col">Order By</th>
					<th scope="col">Date</th>
					<th scope="col">Total</th>
					<th scope="col">Option</th>
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
		<div>
			{{ $orders->appends(['sort' => 'ID'])->links() }}
		</div>
	</div>

	<div class="col-lg-12">
		<hr>
		<h2 class="page-header">All Transactions</h2>
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Balance Change</th>
					<th scope="col">Content</th>
					<th scope="col">Date</th>
				</tr>
			</thead>
			<tbody>
				@foreach($transactions as $transaction)
				<tr class="odd gradeX">
					<td>{{ $transaction->id }}</td>
					<td>{{ $transaction->balance_change }}</td>
					<td>{{ $transaction->content }}</td>
					<td>{{ $transaction->updated_at }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div>
			{{ $transactions->appends(['sort' => 'id'])->links() }}
		</div>
	</div>
</div>

@endsection

<style type="text/css">
.custom-button {
	margin-top: 40px;
	text-align: center;
}
</style>