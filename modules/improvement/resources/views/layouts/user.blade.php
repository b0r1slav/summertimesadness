@extends('layouts.app')

@section('styles')

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/datatables.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user/common.css') }}"/>

@endsection

@section('page')

    <!-- Navigation -->
    @include('improvement::partials.navigation')

    <div class="container">

        @yield('content')

        <hr>

        <!-- Footer -->
        @include('improvement::partials.footer')
    </div>
    <!-- /.container -->

@endsection

@section('scripts')

    <!-- DataTables -->
    <script type="text/javascript" src="{{ asset('js/datatables/datatables.min.js') }}"></script>

    <!-- Custom scripts -->
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('js/user/main.js') }}"></script>
    <script src="{{ asset('js/validation.js') }}"></script>

@endsection