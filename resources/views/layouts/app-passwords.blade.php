<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/libraries/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Neucha" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/passwords.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
            </div>
        </div>
    </nav>

    @yield('page')

</div>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('js/libraries/js/jquery.js') }}"></script>
<script src="{{ asset('js/libraries/js/bootstrap.min.js') }}"></script>

</body>
</html>
