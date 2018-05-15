<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EatPlayWatch Partner | @yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/public/master/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('/public/master/vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{{ asset('/public/master/vendor/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('/public/master/vendor/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('/public/master/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('/public/master/vendor/morrisjs/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('/public/master/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="{{ asset('/public/master/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/public/master/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('/public/master/vendor/metisMenu/metisMenu.min.js') }}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('/public/master/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('/public/master/vendor/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('/public/master/data/morris-data.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('/public/master/dist/js/sb-admin-2.js') }}"></script>

    <!-- DataTables JavaScript -->
    <!-- <script src="{{ asset('master/vendor/datatables/js/jquery.dataTables.min.js') }}"></script> -->
    <!-- <script src="{{ asset('/public/master/vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/public/master/vendor/datatables-responsive/dataTables.responsive.js') }}"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('/public/master/dist/js/sb-admin-2.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}">Laravel</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    @auth
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                    </a>
                    
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i> Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    @endauth
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Language <i class="fa fa-caret-down"></i>
                    </a>
                     <ul class="dropdown-menu dropdown-user">
                        <form id='language-form' action="">
                            <select>
                                <option value="en">English</option>
                                <option value="vi">Vietnamese</option>
                            </select>
                        </form>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->


            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> {{ __('content.sidebar.dashboard')}}</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}/chart"><i class="fa fa-bar-chart-o fa-fw"></i> {{ __('content.sidebar.charts') }}</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cutlery fa-fw"></i> {{ __('content.sidebar.orders') }}<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('/')}}/order?status=completed"><i class="fa fa-check-circle-o fa-fw"></i> {{ __('content.sidebar.complete_orders') }}</a>
                                </li>
                                <li>
                                    <a href="{{url('/')}}/order?status=processing"><i class="fa fa-spinner fa-fw"></i> {{ __('content.sidebar.processing_orders') }}</a>
                                </li>
                                <li>
                                    <a href="{{url('/')}}/order?status=failed"><i class="fa fa-times fa-fw"></i> {{ __('content.sidebar.failed_orders') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{url('/')}}/product"><i class="fa fa-shopping-cart fa-fw"></i> {{ __('content.sidebar.products') }}<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('/')}}/product"><i class="fa fa-shopping-cart fa-fw"></i> {{ __('content.sidebar.all_products') }}</a>
                                </li>
                                <li>
                                    <a href="{{url('/')}}/product/create"><i class="fa fa-edit fa-fw"></i> {{ __('content.sidebar.create_products') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-usd fa-fw"></i> {{ __('content.sidebar.withdraw') }}<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="transaction-history"><i class="fa fa-credit-card fa-fw"></i> Transaction Detail</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-support fa-fw"></i> {{ __('content.sidebar.support') }}</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            @yield('content')
        </div>
    </div>
</body>
</html>