@extends('admin.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('users') }}
@endsection

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('message') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <a type="button" href="{{ route('users.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New User</a>
                    </div>
                </div>

                <table id="users" class="table table-striped" cellspacing="0" width="100%">
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/users/index.js') }}"></script>
@endsection
