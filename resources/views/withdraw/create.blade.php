@extends('master')

@section('title','Withdraw')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.withdraw.information.page_header')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-md-8">
		<form method="POST" action="{{action('PartnerWithdrawController@store')}}">
			{{ csrf_field() }}
			<div class="form-group">
				<label>{{__('content.withdraw.information.label_1')}}</label>
				<input type="text"  class="form-control" value="Bank Transfer" name='method' readonly>
			</div>
			<div class="form-group">
				<label>{{__('content.withdraw.information.label_2')}}</label>
				<input type="text"  class="form-control" name='account_name'>
			</div>
			<div class="form-group">
				<label>A{{__('content.withdraw.information.label_3')}}</label>
				<input type="text"  class="form-control" name='account_number'>
			</div>
			<div class="form-group">
				<label>{{__('content.withdraw.information.label_4')}}</label>
				<input type="text"  class="form-control" name='bank'>
			</div>
			<div class="form-group">
				<label>{{__('content.withdraw.information.label_5')}}</label>
				<input type="text"  class="form-control" name='phone'>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">
					{{__('content.withdraw.information.button_1')}}
				</button>
				<button type="reset" class="btn btn-default">
					{{__('content.withdraw.information.button_2')}}
				</button>
			</div>
		</form>
	</div>
</div>

@endsection