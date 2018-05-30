@extends('master')

@section('title','Dashboard')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.dashboard.page_header')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">

	<div class="col-lg-12">
		<h3>{{__('content.dashboard.header_1')}}</h3>
		<hr>
	</div>
	
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-shopping-cart fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{$numOfProducts}}</div>
						<div>Active Products</div>
					</div>
				</div>
			</div>
			<a href="{{url('/')}}/product">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-spinner fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{$allProcessingOrders}}</div>
						<div>Processing Orders</div>
					</div>
				</div>
			</div>
			<a href="{{url('/')}}/order?status=processing">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-check fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{$allCompletedOrders}}</div>
						<div>Completed Orders</div>
					</div>
				</div>
			</div>
			<a href="{{url('/')}}/order?status=completed">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-money fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{$allAvailableBalance}} $</div>
						<div>In balance</div>
					</div>
				</div>
			</div>
			<a href="{{url('/')}}/balance-detail">
				<div class="panel-footer">
					<span class="pull-left">Check Balance</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<h3>{{__('content.dashboard.header_2')}}</h3>
		<hr>
	</div>
	<div class="col-lg-12">
		<div class="col-md-3">
			<strong>{{__('content.dashboard.label')}}</strong>
		</div>
		<form action="{{action('DashboardController@index')}}" method="post">
			{{ csrf_field() }}
			<div class="form-group row">
				<div class="col-md-2">
					<select name="month" class="form-control">
						<?php
						for ($i = 1; $i <= 12; $i++) {
							$month = ($i < 10) ? '0'.$i : $i;
							echo '<option value="'.$month.'"';
							if ($i == date("n")) echo ' selected="selected"';
							echo '>'.$month.'</option>';
						}
						?>
					</select>
				</div>
				<div class="col-md-2">
					<select name="year" class="form-control">
						<?php
						for ($i = 2018; $i <= 2021; $i++) {
							echo '<option value="'.$i.'"';
							if ($i == date("Y")) echo ' selected="selected"';
							echo '>'.$i.'</option>';
						}
						?>
					</select>
				</div>
				<div class="col-md-3">
					<button type="submit" class="btn btn-primary">{{__('content.dashboard.button')}}</button>
				</div>
			</div>
		</form>
	</div>

	<div class="col-lg-12">
		<h4>{{__('content.dashboard.header_3', ['month' => $monthValue, 'year' => $yearValue])}}</h4>
	</div>

	<div class="col-lg-12">
		<div class="col-lg-4 col-md-6">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-spinner fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$numOfProcessingOrders}}</div>
							<div>Processing Orders</div>
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
							<div class="huge">{{$numOfCompletedOrders}}</div>
							<div>Completed Orders</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-6">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-money fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$amountThisMonth}} $</div>
							<div>In balance</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<h3>{{__('content.dashboard.header_4')}}</h3>
		<hr>
		<ul class="list-group">
			@if (App::getLocale() == 'en')
			@foreach($annoucements as $annoucement)
			<li class="list-group-item">
				<h4>
					<strong>
						{!! $annoucement->eng_title !!}
					</strong>
				</h4>
				<small><i class="fa fa-clock-o"></i> {!!$annoucement->updated_at!!}</small>
				<div>
					{!! $annoucement->eng_content !!}
				</div>
			</li>
			@endforeach
			@elseif(App::getLocale() == 'vi')
			@foreach($annoucements as $annoucement)
			<li class="list-group-item">
				<h4>
					<strong>
						{!! $annoucement->vie_title !!}
					</strong>
				</h4>
				<small><i class="fa fa-clock-o"></i> {!!$annoucement->updated_at!!}</small>
				<div>
					{!! $annoucement->vie_content !!}
				</div>
			</li>
			@endforeach
			@endif
		</ul>

	</div>
</div>
@endsection

<style type="text/css">
.list-group-item h4{
	margin-right: 10px;
	float: left;
}

.list-group-item small {
	margin-left: 10px;
	float: right;
}

.list-group-item div {
	clear: both;
}
</style>