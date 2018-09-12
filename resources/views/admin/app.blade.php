<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <!-- Bootstrap -->
    <link href="{{ asset('css/libraries/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.min.css') }}"/>
    <!-- Common Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}"/>

    @yield('styles')

    <!-- Custom Theme Style -->
    <link href="{{ asset('css/custom-theme-style.css') }}" rel="stylesheet">


</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{ url('home') }}" class="site_title">
                            <i class="fa fa-paw"></i>
                            <span>Summertime Sadness</span>
                        </a>
                    </div>

                    <div class="clearfix"></div>
                    <!-- menu profile quick info -->
                    @include('admin.sections.sidebar-user-info')
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    @include('admin.sections.sidebar')
                    <!-- /sidebar menu -->
                </div>
            </div>

            <!-- top navigation -->
        @include('admin.sections.navigation')
        <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                @yield('breadcrumbs')

                <div class="row">

                    @yield('content')

                </div>

            </div>
            <!-- /page content -->

            <!-- footer content -->
        @include('admin.sections.footer')
            <!-- /footer content -->
        </div>
    </div>
    <script src="{{ asset('js/libraries/js/jquery.js') }}"></script>
    <script src="{{ asset('js/libraries/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
    <script type="text/javascript" src="{{ asset('js/datatables/datatables.min.js') }}"></script>
    <!-- Common scripts -->
    <script src="{{ asset('js/common.js') }}"></script>
    <!-- Admin scripts -->
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <!-- Validation scripts -->
    <script src="{{ asset('js/validation.js') }}"></script>

    @yield('scripts')

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('js/admin/custom-theme-scripts.js') }}"></script>

</body>
</html>
