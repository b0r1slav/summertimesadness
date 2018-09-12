@extends('admin.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('users.edit', $user) }}
@endsection

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form method="POST" action="{{ route('users.update', $user) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label class="required" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ old('name', $user->name) }}"
                               aria-describedby="nameHelp" placeholder="Enter name" required>
                        @if ($errors->has('name'))
                            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="required" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ old('email', $user->email) }}"
                               aria-describedby="emailHelp" placeholder="Enter email" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Password">
                        <small id="passwordHelp" class="form-text text-muted">The password must be at least six characters!</small>
                        @if ($errors->has('password'))
                            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a type="btn" class="btn btn-info" href="{{ route('users.index') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>

@endsection
