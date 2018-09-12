<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email"
               value="@if(session('auth_method') == 'login') {{ old('email') }} @endif"
               placeholder="Enter email" required autofocus>
        @if ($errors->has('email') && session('auth_method') == 'login')
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        @if ($errors->has('password')  && session('auth_method') == 'login')
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="remember-me"
               name="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember-me">Remember Me</label>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <a class="btn btn-link" href="{{ route('password.request') }}">
        Forgot Your Password?
    </a>
</form>
