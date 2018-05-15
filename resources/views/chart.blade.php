@extends('master')

@section('title','Charts')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.chart.title')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div>
	<div>{{__('content.chart.subtitle')}}</div><br>
	<form action="{{action('ChartController@index')}}" method="post">
		{{ csrf_field() }}
		<div class="form-group row">
			<div class="col-md-4">
				<select name="month" class="form-control">
					<option value="1">January</option>
					<option value="2">February</option>
					<option value="3">March</option>
					<option value="4">April</option>
					<option value="5">May</option>
					<option value="6">June</option>
					<option value="7">July</option>
					<option value="8">August</option>
					<option value="9">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
			</div>
			<div class="col-md-4">
				<select name="year" class="form-control">
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
				</select>
			</div>
			<div class="col-md-4">
				<button type="submit" class="btn btn-primary">{{__('content.chart.button')}}</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div id="chart_div"></div>
	</div>

	@endsection

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {packages: ['corechart', 'line']});
		google.charts.setOnLoadCallback(drawBackgroundColor);

		function drawBackgroundColor() {
			var orders = {!! json_encode($orders->toArray()) !!};
			var data = new google.visualization.DataTable();
			data.addColumn('number', 'order');
			data.addColumn('number', 'day');

			orders.forEach(function(order){
				data.addRows([[order['day'], order['count']]]);
			});


			var options = {
				title: 'Numbers of order in this month',
				hAxis: {
					title: 'Day'
				},
				vAxis: {
					title: 'Orders',
					viewWindow: {
						min: 1,
						max: 31
					},
				},
				backgroundColor: '#fff'
			};

			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		}
</script>