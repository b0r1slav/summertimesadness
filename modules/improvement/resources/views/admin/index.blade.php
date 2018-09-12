@extends('admin.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/improvement/index.css') }}"/>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('evaluations') }}
@endsection

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table id="evaluations-users" class="table" cellspacing="0" width="100%">
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin/improvement/index.js') }}"></script>
@endsection