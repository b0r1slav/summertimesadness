<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'SummertimeSadness') }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/libraries/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Neucha" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

</head>

<body id="page-top">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">
                SummertimeSadness
            </a>
        </div>
    </div>
</nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-4 col-md-offset-4">

                <!-- Login -->
                <div class="well transparent-item" id="login">
                    <h4>Login</h4>
                    @include('auth.login')
                </div>

            </div>

        </div>
        <!-- /.row -->

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <p>Copyright &copy; www.summertimesadness.ga 2018</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="{{ asset('js/libraries/js/jquery.js') }}"></script>

    <!-- Bootstrap Core Javascript -->
    <script src="{{ asset('js/libraries/js/bootstrap.min.js') }}"></script>
</body>

</html>
