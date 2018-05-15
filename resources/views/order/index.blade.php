@extends('master')

@section('title','All Orders of Your Products')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">All Orders of Your Products</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Status</th>
					<th scope="col">Order by</th>
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
							<button class="btn btn-primary btn-sm">View</button>
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
</div>


@endsection