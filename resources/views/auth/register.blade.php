<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name"
               value="@if(session('auth_method') == 'register') {{ old('name') }} @endif"
               aria-describedby="nameHelp" placeholder="Enter name" required>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email"
               value="@if(session('auth_method') == 'register') {{ old('email') }} @endif"
               aria-describedby="emailHelp" placeholder="Enter email" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        @if ($errors->has('email') && session('auth_method') == 'register')
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Password" required>
        <small id="passwordHelp" class="form-text text-muted">The password must be at least six characters!</small>
        @if ($errors->has('password') && session('auth_method') == 'register')
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="password-confirm">Confirm Password</label>
        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Sign Up</button>
</form>