@extends("master")

@section('title','Admin Dashboard')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Admin Dashboard</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="col-lg-12">
	<div class="col-md-3">
		<strong>Choose month and year:</strong>
	</div>
	<form action="{{action('DashboardController@adminDashboardInMonth')}}" method="post">
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
				<button type="submit" class="btn btn-primary">{{__('View')}}</button>
			</div>
		</div>
	</form>
</div>


<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header">Statistics in {{$monthValue}}/{{$yearValue}}</h2>
	</div>
	<div class="col-lg-6">
		<h3 class="page-header">Orders</h3>

		<div class="col-lg-6 col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-check-circle fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$completedOrders}}</div>
							<div>Completed Orders</div>
						</div>
					</div>
				</div>
				<a href="{{url('/')}}/admin">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>

		<div class="col-lg-6 col-md-6">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-clock-o fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$pendingOrders}}</div>
							<div>Pending Orders</div>
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

		<div class="col-lg-12 col-md-6">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-remove fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$failedOrders}}</div>
							<div>Failed Orders</div>
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
	</div>

	<div class="col-lg-6">
		<h3 class="page-header">Money Statistics</h3>

		<div class="col-lg-6 col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-money fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$totalAmount}}</div>
							<div>From Orders</div>
						</div>
					</div>
				</div>
				<a href="{{url('/')}}/admin">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>

		<div class="col-lg-6 col-md-6">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-reply fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$spent}}</div>
							<div>Spend for partners</div>
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

		<div class="col-lg-6 col-md-6">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-history fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$debt}}</div>
							<div>In debt</div>
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

		<div class="col-lg-6 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-usd fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$interest}}</div>
							<div>Interest</div>
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
	</div>
	
</div>

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Chart</h3>
	</div>
	<div class="col-lg-12">
		<div id="linechart_material" style="height: 500px"></div>
	</div>
</div>

@endsection

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.charts.load('current', {'packages':['line']});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		var chartData = {!! json_encode($chartData->toArray()) !!};
		console.log(chartData);
		if(chartData == null) return;
		var data = new google.visualization.DataTable();
		data.addColumn('number', 'Day');
		data.addColumn('number', 'Total Collection');
		data.addColumn('number', 'Interest');

		chartData.forEach(function(chartElement) {
			data.addRows([[chartElement['day'], chartElement['total'], chartElement['interestValue']]]);
		});

		var d = new Date();
		var month = d.getMonth()+1;
		var year = d.getFullYear();
		var options = {
			title: 'Money Statistics in ' + month + '/' + year,
			width: 900,
			height: 500,
			hAxis: {
				title: 'Day',
				viewWindow: {
					min: 1,
					max: 31,
				},
				gridlines: {
					count: 16
				}
			}
		};

		var chart = new google.charts.Line(document.getElementById('linechart_material'));

		chart.draw(data, google.charts.Line.convertOptions(options));
	}
</script>