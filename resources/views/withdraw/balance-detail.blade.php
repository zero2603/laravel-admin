@extends('master')

@section('title','Withdraw')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.withdraw.balance_detail.page_header')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-4 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-money fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{$available}}</div>
						<div>Available Balance</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-lg-4 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-spinner fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{(-1)*$pending}}</div>
						<div>Pending Withdraw</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-check fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{(-1)*$paid}}</div>
						<div>Total Withdraw</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		{{__('content.withdraw.balance_detail.content')}} <a href="{{url('/')}}/withdraw/create">{{__('content.withdraw.balance_detail.link')}}</a>.
		<br><br>
		@if($available >= 100 &&  count($info) != 0)
		<div class="text-center">
			<form method="POST" action="{{action('PartnerWithdrawController@makeWithdraw')}}">
				@csrf
				<input type="hidden" name="total" value="{{$available}}">
				<button type="submit" class="btn btn-success btn-lg">{{__('content.withdraw.balance_detail.button')}}</button>
			</form>
		</div>
		@else
		<div class="alert alert-danger">
			{{__('content.withdraw.balance_detail.message')}}
		</div>
		@endif
	</div>	
</div>

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">{{__('content.withdraw.balance_detail.header')}}</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">{{__('content.withdraw.balance_detail.column_name_1')}}</th>
					<th scope="col">{{__('content.withdraw.balance_detail.column_name_2')}}</th>
					<th scope="col">{{__('content.withdraw.balance_detail.column_name_3')}}</th>
					<th scope="col">{{__('content.withdraw.balance_detail.column_name_4')}}</th>
					<th scope="col">{{__('content.withdraw.balance_detail.column_name_5')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($transactions as $transaction)
				<tr class="odd gradeX">
					<td>{{ $transaction->id }}</td>
					<td>{{ $transaction->balance_change }}</td>
					<td>{{ $transaction->status }}</td>
					<td>{{ $transaction->content }}</td>
					<td>{{ $transaction->updated_at }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div>
			{{ $transactions->appends(['sort' => 'ID'])->links() }}
		</div>
	</div>
</div>

@endsection