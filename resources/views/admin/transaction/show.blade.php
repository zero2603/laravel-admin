@extends('master')

@section('title','All Transactions')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('Detail Transactions')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-md-8">
		<div class="form-group">
			<label>Partner ID</label>
			<input type="text"  class="form-control" value="{{$transaction->partner_id}}" readonly>
		</div>
		<div class="form-group">
			<label>Balance change</label>
			<input type="text"  class="form-control" value="{{$transaction->balance_change}}" readonly>
		</div>
		<div class="form-group">
			<label>Status</label>
			<input type="text"  class="form-control" value="{{$transaction->status}}" readonly>
		</div>
		<div class="form-group">
			<label>Content</label>
			<input type="text"  class="form-control" value="{{$transaction->content}}" readonly>
		</div>
		<div class="form-group">
			<label>Note</label>
			<div>{!! $transaction->note !!}</div>
		</div>
		<div class="form-group">
			<label>Date</label>
			<input type="text"  class="form-control" value="{{$transaction->updated_at}}" readonly>
		</div>
		@if($transaction->status == 'pending')
		<div class="col-md-2">
			<form method="POST" action="{{action('PartnerTransactionController@update', $transaction->id)}}">
				@csrf
				<input name="_method" type="hidden" value="PATCH">
				<input type="hidden" name="status" value="approved">
				<button type="submit" class="btn btn-primary">Approve</button>
			</form>
		</div>
		
		<div class="col-md-2">
			<form method="POST" action="{{action('PartnerTransactionController@update', $transaction->id)}}">
				@csrf
				<input name="_method" type="hidden" value="PATCH">
				<input type="hidden" name="status" value="denied">
				<button type="submit" class="btn btn-danger">Deny</button>
			</form>
		</div>
		@elseif($transaction->status == 'approved')
		<div class="col-md-2">
			<form method="POST" action="{{action('PartnerTransactionController@update', $transaction->id)}}">
				@csrf
				<input name="_method" type="hidden" value="PATCH">
				<input type="hidden" name="status" value="completed">
				<button type="submit" class="btn btn-success">Completed</button>
			</form>
		</div>
		<div class="col-md-2">
			<form method="POST" action="{{action('PartnerTransactionController@update', $transaction->id)}}">
				@csrf
				<input name="_method" type="hidden" value="PATCH">
				<input type="hidden" name="status" value="denied">
				<button type="submit" class="btn btn-danger">Deny</button>
			</form>
		</div>
		@elseif($transaction->status == 'denied')
		<form method="POST" action="{{action('PartnerTransactionController@update', $transaction->id)}}">
			@csrf
			<input name="_method" type="hidden" value="PATCH">
			<input type="hidden" name="status" value="approved">
			<button type="submit" class="btn btn-primary">Approve</button>
		</form>
		@else
		<div class="alert alert-success" role="alert">
			This transaction is completed!
		</div>
		@endif
	</div>
</div>

@endsection