@extends('improvement::layouts.user')

@section('styles')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user/evaluations-index.css') }}"/>
@endsection

@section('content')

    <!-- Modal -->
    @include('improvement::components.modal-add-points')

    <!-- Templates -->
    @include('improvement::templates.pending-approval-row')
    @include('improvement::templates.daily-tasks-row')
    @include('improvement::templates.popover')

    <!-- Page Content -->
    <div class="row">

        <div class="col-lg-12">

            <!-- Title -->
            <h1 class="break-word">Evaluations</h1>

        </div>

        <div id="daily-tasks" class="col-md-3">
            <h4>Daily Tasks</h4>
            <div id="daily-tasks-content" class="side-content">
                <table id="daily-tasks-table" class="table">
                    <tbody>
                    {{--fill with js--}}
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-6">
            <table id="evaluations" class="table table-bordered" cellspacing="0" width="100%">
            </table>
        </div>

        <div id="pending-approval" class="col-md-3">
            <h4>Pending approval/Approved/Refused</h4>
            <div id="pa-content" class="side-content">
                <table id="pa-table" class="table">
                    <tbody>
                    {{--fill with js--}}
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- /.row -->

@endsection
@section('scripts')
    @parent
    <script src="{{ asset('js/user/evaluations-index.js') }}"></script>
@endsection