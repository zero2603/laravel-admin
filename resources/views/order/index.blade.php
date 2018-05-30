@extends('master')

@section('title','All Orders of Your Products')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.order.index.page_header')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">{{__('content.order.index.column_name_1')}}</th>
					<th scope="col">{{__('content.order.index.column_name_2')}}</th>
					<th scope="col">{{__('content.order.index.column_name_3')}}</th>
					<th scope="col">{{__('content.order.index.column_name_4')}}</th>
					<th scope="col">{{__('content.order.index.column_name_5')}}</th>
					<th scope="col">{{__('content.order.index.column_name_6')}}</th>
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
							<button class="btn btn-primary btn-sm">{{__('content.order.button_1')}}</button>
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