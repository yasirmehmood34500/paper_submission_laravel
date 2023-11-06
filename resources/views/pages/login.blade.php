<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('includes.css')
</head>

<body>
    <div class="auth">
        <div class="auth-container">
            <div class="card">
                <header class="auth-header">
                    <h1 class="auth-title">{{ config('app.name') }} Login</h1>
                </header>
                <div class="auth-content">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form id="login-form" action="{{ route('login_req') }}" method="POST" novalidate="">
                        @csrf
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="email" class="form-control underlined" value="{{ old('email') }}"
                                name="email" placeholder="Your email address" required>
                        </div>
                        @error('email')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control underlined" name="password"
                                placeholder="Your password" value="{{ old('password') }}" required>
                        </div>
                        @error('password')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Login</button>
                        </div>
                        <div class="form-group">
                            <p class="text-muted text-center">Do not have an account?
                                <a href="{{ route('register') }}">Sign Up!</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('includes.primary-color')
    @include('includes.js')
</body>

</html>
