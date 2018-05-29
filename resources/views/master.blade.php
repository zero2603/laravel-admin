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
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0px">
                <div style="line-height: 35px;">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{url('/')}}">
                            <img id="logo" src="{{ asset('/public/master/img/eatplaywatch.png') }}">
                        </a>
                    </div>
                    <!-- /.navbar-header -->

                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                Language <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-messages" style="width: 150px">
                                <li><a href="{{url('/').'/en/dashboard'}}"><img src="{{ asset('/public/master/img/english.png') }}"><span> English</span></a></li>
                                <li><a href="{{url('/').'/vi/dashboard'}}"><img src="{{ asset('/public/master/img/vietnam.png') }}"><span> Vietnamese</span></a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            @auth
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="{{action('UserController@getProfile', Auth::id())}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
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
                    </ul>
                    <!-- /.navbar-top-links -->
                </div>    

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            @if(Auth::user()->role == 0)
                            <li class="sidebar-search">
                                <form class="form-inline" action="{{action('SearchController@search')}}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="keyword" placeholder="Search...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">
                                                Search
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </li>
                            <li>
                                <a href="{{url('/')}}/dashboard"><i class="fa fa-dashboard fa-fw"></i> {{ __('content.sidebar.dashboard')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/chart"><i class="fa fa-bar-chart-o fa-fw"></i> {{ __('content.sidebar.charts') }}</a>
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
                                <a href="#"><i class="fa fa-usd fa-fw"></i> {{ __('content.sidebar.withdraw') }}<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{url('/')}}/withdraw/create"><i class="fa fa-credit-card fa-fw"></i> Withdraw Information</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/')}}/balance-detail"><i class="fa fa-money fa-fw"></i> Balance Detail</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-support fa-fw"></i> {{ __('content.sidebar.support') }}</a>
                            </li>
                            @elseif(Auth::user()->role == 1) 
                            <li>
                                <a href="{{url('/')}}/admin/dashboard"><i class="fa fa-line-chart fa-fw"></i> {{ __('Dashboard')}}<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{url('/')}}/admin/dashboard/month"><i class="fa fa-calendar fa-fw"></i> View by month</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/')}}/admin/dashboard/"><i class="fa fa-history fa-fw"></i> All time</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/users"><i class="fa fa-users fa-fw"></i> {{ __('Users Management')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/transactions"><i class="fa fa-book fa-fw"></i> {{ __('Transactions Management')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/orders"><i class="fa fa-inbox fa-fw"></i> {{ __('Orders Management')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/annoucements"><i class="fa fa-bullhorn fa-fw"></i> {{ __('Annoucements Management')}}<span class="fa arrow"></span>s</a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{url('/')}}/admin/annoucements"><i class="fa fa-bullhorn fa-fw"></i> All Annoucements</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/')}}/admin/annoucements/create"><i class="fa fa-edit fa-fw"></i> Create an annoucement</a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                @yield('content')
            </div>
            <footer class="mainfooter" role="contentinfo">

                <div class="footer-middle">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <!--Column1-->
                                <div class="footer-pad">
                                    <h4>Address</h4>
                                    <address>
                                        <ul class="list-unstyled">
                                            <li>
                                                City Hall<br>
                                                212  Street<br>
                                                Lawoma<br>
                                                735<br>
                                            </li>
                                            <li>
                                                Phone: 0
                                            </li>
                                        </ul>
                                    </address>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <!--Column1-->
                                <div class="footer-pad">
                                    <h4>Popular Services</h4>
                                    <ul class="list-unstyled">
                                        <li><a href="#"></a></li>
                                        <li><a href="#">Payment Center</a></li>
                                        <li><a href="#">Contact Directory</a></li>
                                        <li><a href="#">Forms</a></li>
                                        <li><a href="#">News and Updates</a></li>
                                        <li><a href="#">FAQs</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <!--Column1-->
                                <div class="footer-pad">
                                    <h4>Website Information</h4>
                                    <ul class="list-unstyled">
                                        <li><a href="#">Website Tutorial</a></li>
                                        <li><a href="#">Accessibility</a></li>
                                        <li><a href="#">Disclaimer</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">FAQs</a></li>
                                        <li><a href="#">Webmaster</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <!--Column1-->
                                <div class="footer-pad">
                                    <h4>Popular Departments</h4>
                                    <ul class="list-unstyled">
                                        <li><a href="#">Parks and Recreation</a></li>
                                        <li><a href="#">Public Works</a></li>
                                        <li><a href="#">Police Department</a></li>
                                        <li><a href="#">Fire</a></li>
                                        <li><a href="#">Mayor and City Council</a></li>
                                        <li>
                                            <a href="#"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <!--Footer Bottom-->
                                <p class="text-center">&copy; Copyright 2016 - City of USA.  All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>

