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
	<div class="col-md-8">
		<form method="POST" action="{{action('PartnerWithdrawController@store')}}">
			{{ csrf_field() }}
			<div class="form-group">
				<label>Withdraw Method:</label>
				<input type="text"  class="form-control" value="Bank Transfer" name='method' readonly>
			</div>
			<div class="form-group">
				<label>Account Holder Name:</label>
				<input type="text"  class="form-control" name='account_name'>
			</div>
			<div class="form-group">
				<label>Account Number:</label>
				<input type="text"  class="form-control" name='account_number'>
			</div>
			<div class="form-group">
				<label>Bank Name and bank branch:</label>
				<input type="text"  class="form-control" name='bank'>
			</div>
			<div class="form-group">
				<label>Contact phone number:</label>
				<input type="text"  class="form-control" name='phone'>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">
					{{__('content.products.button_next')}}
				</button>
				<button type="reset" class="btn btn-default">
					{{__('content.products.button_cancel')}}
				</button>
			</div>
		</form>
	</div>
</div>

@endsection