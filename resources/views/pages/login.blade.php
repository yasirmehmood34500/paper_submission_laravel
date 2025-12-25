<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('includes.css')
    <style>
        .auth-login {
            width: 500px !important;
            margin: auto !important;
            margin-top: 20px !important;
        }

        .dflex {
            display: flex;
        }

        .first {
            padding: 10px 30px;
            width: 10%;
        }

        .second {
            margin-top: 18px;
            width: 80%;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="auth">
        <div class="dflex"
            style="background: {{ config('constants.journal_login_bg_color') }}; color: {{ config('constants.journal_login_text_color') }};">
            <div class="first" style="">
                <a href="{{ config('constants.journal_url') }}"><img style="width: 150px; height: auto;"
                        src="{{ asset('assets/img/logo.png') }}" alt=""></a>
            </div>
            <div class="second">
                <span>Manuscript Submission Portal</span>
                <h1>{{ config('constants.journal_name') }}</h1>
                <span>&nbsp;</span>
            </div>
        </div>
        <div class="auth-container auth-login">
            <div class="card">
                <header class="auth-header">
                    <h1 class="auth-title">{{ config('constants.journal_stand_for') }} Login</h1>
                </header>
                <div class="auth-content">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form id="login-form" action="{{ route('login_req') }}" method="POST" novalidate="">
                        @csrf
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="email" class="form-control underlined" value="{{ old('email') }}" name="email"
                                placeholder="Your email address" required>
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
                            <p class="text-muted text-center">do not have an account?
                                <a href="{{ route('register') }}">Sign Up!</a>
                            </p>
                        </div>
                        <div class="form-group">
                            <p class="text-muted text-center">
                                <a href="{{ route('forget_password_page') }}">Forget Password</a>
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