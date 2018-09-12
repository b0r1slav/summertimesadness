<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/libraries/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Neucha" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">

    @yield('styles')

</head>

<body>

    @yield('page')

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('js/libraries/js/jquery.js') }}"></script>
    <script src="{{ asset('js/libraries/js/bootstrap.min.js') }}"></script>

    @yield('scripts')

</body>

</html>

