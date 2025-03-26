<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('includes.css')
</head>

<body>
    <div class="auth">
        <div class="row"
            style="background: {{ config('constants.journal_login_bg_color') }}; color: {{ config('constants.journal_login_text_color') }};">
            <div class="col-md-2" style="padding: 10px 30px;">
                <a href="{{ config('constants.journal_url') }}"><img style="width: 100px; height: 100px;"
                        src="{{ asset('storage') }}/{{ config('constants.journal_login_logo') }}?v1.0.1"
                        alt=""></a>
            </div>
            <div class="col-md-10" style="display: flex; align-items: center;">
                <h1>{{ config('constants.journal_name') }}</h1>
            </div>
        </div>
        <div class="auth-container">
            <div class="card">
                <header class="auth-header">
                    <h1 class="auth-title">{{ config('constants.journal_stand_for') }} Reset Password</h1>
                </header>
                <div class="auth-content">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-danger">{{ session('success') }}</div>
                    @endif
                    <form id="login-form"
                        action="{{ route('reset_password_req', ['token' => request()->route('token')]) }}"
                        method="POST" novalidate="">
                        @csrf
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control underlined" name="password"
                                placeholder="Your password" value="{{ old('password') }}" minlength="8" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control underlined" name="password_confirmation"
                                placeholder="Your Confirm password" value="{{ old('password_confirmation') }}"
                                minlength="8" required>
                        </div>
                        @error('password')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Reset Password</button>
                        </div>
                        <div class="form-group">
                            <p class="text-muted text-center">I have an account?
                                <a href="{{ route('login') }}">Sign In!</a>
                            </p>
                        </div>
                    </form>
                    <div class="text-center">
                        Developed by
                        <a href="https://timetechsol.com" target="_blank">TimeTechSol</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('includes.primary-color')
    @include('includes.js')
</body>

</html>
