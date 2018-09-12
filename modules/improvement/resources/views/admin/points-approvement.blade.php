@extends('admin.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-checkbox.css') }}"/>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('points-approvement') }}
@endsection

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="col-lg-12" id="notifications">
                    {{--this will be populated with JS--}}
                </div>

                {{--Templates--}}
                @include('improvement::templates.bulk-notification')
                @include('improvement::templates.checkbox')

                <table id="points-approvement" class="table" cellspacing="0" width="100%">
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin/improvement/points-approvement.js') }}"></script>
@endsection