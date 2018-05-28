@extends("master")

@section('title','Admin Dashboard')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Admin Dashboard</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-lg-6">
		<h3 class="page-header">Product</h3>

		<div class="col-lg-6 col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-shopping-cart fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$activeProducts}}</div>
							<div>Active Products</div>
						</div>
					</div>
				</div>
				<a href="{{url('/')}}/admin/users">
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
							<i class="fa fa-clock-ofa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$pendingProducts}}</div>
							<div>Pending Products</div>
						</div>
					</div>
				</div>
				<a href="{{url('/')}}/admin/">
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
		<h3 class="page-header">Partners</h3>

		<div class="col-lg-6 col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-users fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">{{$activePartners}}</div>
							<div>Active Partners</div>
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
							<div class="huge">{{$pendingPartners}}</div>
							<div>Pending Partners</div>
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
							<div class="huge">{{$totalAmount-$spent}}</div>
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

@endsection
