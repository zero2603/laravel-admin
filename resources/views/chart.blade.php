@extends('master')

@section('title','Charts')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{__('content.chart.page_header')}}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div>{{__('content.chart.header')}}</div><br>
	<form action="{{action('ChartController@getData')}}" method="post">
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
				<button type="submit" class="btn btn-primary">{{__('content.chart.button')}}</button>
			</div>
		</div>
	</form>
	<div class="row">
		<div id="chart_div" style="height: 500px; width: 960px"></div>
	</div>
</div>
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
					max: 32,
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
@endsection

