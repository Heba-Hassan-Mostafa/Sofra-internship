<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Sofra </title>
    <!-- Tell the browser to be responsive to screen width -->
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/css/all.css')}}" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/v4-shims.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/css/ionicons.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('adminlte/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{asset('adminlte/plugins/css?family=Source+Sans+Pro:300,400,400i,700')}}" rel="stylesheet">
    <link href="{{asset(public_path('css/styles.css'))}}" rel="stylesheet">



    @if (app()->getLocale() == 'ar')

        <link rel="stylesheet" href="{{ asset('adminlte/css/font-awesome-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/css/AdminLTE-rtl.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('adminlte/css/bootstrap-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/css/rtl.css') }}">

        <style>
            body, h1, h2, h3, h4, h5, h6 {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>
    @else
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <link rel="stylesheet" href="{{asset('adminlte/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{asset('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">
    @endif


        </head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../../index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
            <div class="pull-right">

                <form action="{{ url('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="btn  btn-lg btn-primary "> {{__('lang.logout')}}</button>
                </form>
            </div>

        </ul>
    </nav>

    <header class="main-header">
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

<div class="navbar-custom-menu">
<ul class="nav navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            @lang('lang.languages')
</a>
<div class="dropdown-menu">
    <ul style="list-style-type: none; margin:2px" class="text-center ">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li style=" padding-bottom:10px" >
    <a  rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
        {{ $properties['native'] }}
    </a>
            </li>
                @endforeach
            </ul>
        </div>
    </li>

                </ul>
            </div>
        </nav>
    </header>





    <!-- Right navbar links -->
{{--        <ul class="navbar-nav ml-auto">--}}

{{--        </ul>--}}
{{--    </nav>--}}

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link">
            <img src="{{asset('adminlte/img/AdminLTELogo.png')}}"
                 alt="Blood Bank Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Sofra</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{auth()->user()->name}}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="{{url(route('client.index'))}}" class="nav-link">
                <i class="fa fa-users"></i>
                <p>Clients</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url(route('restaurant.index'))}}" class="nav-link">
                <i class="fas fa-utensils"></i><p>Restaurants</p>
            </a>
        </li>

                    <li class="nav-item">
                        <a href="{{url(route('meal.index'))}}" class="nav-link">
                            <i class="fas fa-utensils"></i><p>Meals</p>
                        </a>
                    </li>

                    <li class="nav-item">
            <a href="{{url(route('payments.index'))}}" class="nav-link">
                <i class="fas fa-many"></i><p>Restaurant Payments</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url(route('category.index'))}}" class="nav-link">
                <i class="fa fa-list"></i>
                <p>Categories</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url(route('offer.index'))}}" class="nav-link">
                <i class="fas fa-list"></i> <p>Offers</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url(route('order.index'))}}" class="nav-link">
                <i class="fad fa-french-fries"></i>
                <p>Orders</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{url(route('city.index'))}}" class="nav-link">
                <i class="fas fa-map-marker-alt"></i>
                <p>Cities</p>
            </a>
        </li>




        <li class="nav-item">
            <a href="{{url(route('contact.index'))}}" class="nav-link">
                <i class="fas fa-phone"></i>
                <p>Contacts</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url(route('setting.index'))}}" class="nav-link">
                <i class="fas fa-cogs"></i>
                <p>Settings</p>
            </a>
        </li>


        <li class="nav-item">
            <a href="{{url(route('user.index'))}}" class="nav-link">
                <i class="fa fa-users"></i>
                <p>Users</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url(route('user.change-password'))}}" class="nav-link">
                <i class="fa fa-key"></i>
                <p>Change Password</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{url(route('role.index'))}}" class="nav-link">
                <i class="fas fa-user-lock"></i>
                <p>Roles</p>
            </a>
        </li>





                </ul>
            </nav>
            <!-- /.sidebar-menu -->


            <!-- /.sidebar -->
        </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
    <div class="col-sm-6">
        <h1>@yield('page_header')</h1>
        <small>@yield('page_description')</small>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.0-beta.1
        </div>
        <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">Sofra.io</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/js/demo.js')}}"></script>


@stack('scripts')

</body>
</html>
