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
					<option value="1" class="month_value">January</option>
					<option value="2" class="month_value">February</option>
					<option value="3" class="month_value">March</option>
					<option value="4" class="month_value">April</option>
					<option value="5" class="month_value">May</option>
					<option value="6" class="month_value">June</option>
					<option value="7" class="month_value">July</option>
					<option value="8" class="month_value">August</option>
					<option value="9" class="month_value">September</option>
					<option value="10" class="month_value">October</option>
					<option value="11" class="month_value">November</option>
					<option value="12" class="month_value">December</option>
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
	</form>
	<div class="row">
		<div id="chart_div" style="height: 500px; width: 960px"></div>
	</div>

	@endsection

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {packages: ['corechart', 'line']});
		google.charts.setOnLoadCallback(drawBackgroundColor);

		function drawBackgroundColor() {
			var orders = {!! json_encode($orders->toArray()) !!};
			var data = new google.visualization.DataTable();
			data.addColumn('number', 'day');
			data.addColumn('number', 'order');

			orders.forEach(function(order){
				data.addRows([[order['day'], order['count']]]);
			});

			var d = new Date();
			var month = d.getMonth()+1;
			var year = d.getFullYear();
			var options = {
				title: 'Numbers of order in ' + month + '/' + year,
				hAxis: {
					title: 'Day',
					viewWindow: {
						min: 1,
						max: 31,
					},
					gridlines: {
						count: 16
					}
				},
				vAxis: {
					title: 'Orders',
					viewWindow: {
						min: 0,
						max: 50,
					},
					gridlines: {
						count: 20,
					}
				},
				curverType: 'function',
				pointSize: 10,
				backgroundColor: '#fff',
				chartArea: {
		            left: 60,
		            top: 40,
		            width: 1000,
		            height: 400
		        }
			};

			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		}
	</script>