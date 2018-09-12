@extends('admin.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-checkbox.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/improvement/show.css') }}"/>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('evaluations.show', $user) }}
@endsection

@section('content')

    <div class="col-lg-12" id="notifications">
        {{--this will be populated with JS--}}
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('improvement::partials.daily-tasks')
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        @include('improvement::partials.evaluations')
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/admin/improvement/show.js') }}"></script>
@endsection