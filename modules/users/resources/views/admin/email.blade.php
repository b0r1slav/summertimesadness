@extends('admin.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('users.mail', $user) }}
@endsection

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                @include('components.exception')

                <form id="form-email" method="POST" action="{{ route('users.send-email', $user) }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="subject" class="form-control" id="email-subject"
                               placeholder="Subject" maxlength="255" value="{{ old('subject') }}" required>
                        @if ($errors->has('subject'))
                            <span class="help-block">
                    <strong>{{ $errors->first('subject') }}</strong>
                </span>
                        @endif
                    </div>
                    <div class="form-group">
                        @include('components.wysiwyg')
                        @if ($errors->has('body'))
                            <span class="help-block">
                    <strong>{{ $errors->first('body') }}</strong>
                </span>
                        @endif
                        <label for="email-body"></label>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-send-o"></i> Send</button>
                    <a type="btn" class="btn btn-info" href="{{ route('users.index') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/admin/users/email.js') }}"></script>
@endsection