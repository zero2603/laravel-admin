@extends('master')

@section('title','All Orders of Your Products')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.order.title')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
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
		<div>
			{{ $orders->appends(['sort' => 'ID'])->links() }}
		</div>
	</div>
</div>


@endsection