@extends('master')

@section('title','Withdraw')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Withdraw</h1>
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
		When your account reaches the minimum amount (100$) or more, you may request your withdraw by clicking the 'Withdraw' button. If not, an alert will appear. The withdraw request may be takes 5 days for processing.
		You can fill or update your withdraw information <a href="{{url('/')}}/withdraw/create">here</a>.
		<br><br>
		@if($available >= 100 &&  count($info) != 0)
		<div class="text-center">
			<form method="POST" action="{{action('PartnerWithdrawController@makeWithdraw')}}">
				@csrf
				<input type="hidden" name="total" value="{{$available}}">
				<button type="submit" class="btn btn-success btn-lg">Withdraw</button>
			</form>
		</div>
		@else
		<div class="alert alert-danger">
			Condition for make a withdraw is your available balance must be greater than 100$ or you have not filled out the information yet.
		</div>
		@endif
	</div>
	
	
</div>

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Transaction History</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<table width="100%" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Balance Change</th>
					<th scope="col">Status</th>
					<th scope="col">Content</th>
					<th scope="col">Date</th>
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