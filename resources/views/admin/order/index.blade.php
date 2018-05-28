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
					<th scope="col" colspan="2">{{__('content.order.option')}}</th>
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
						<a href="{{action('OrderController@showInAdmin', $order->ID)}}">
							<button class="btn btn-primary btn-sm">{{__('content.order.button_view')}}</button>
						</a>
					</td>
					<td>
						<form  method="POST" action="{{action('OrderController@destroy', $order->ID)}}">
							@csrf
							<input name="_method" type="hidden" value="DELETE">
							<button class="btn btn-danger btn-sm" type="submit">{{__('Delete')}}</button>
						</form>
						</form>
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