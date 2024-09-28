@extends('Backend.auth.auth_master')
@section('auth-content')
<div class="main-wrapper login-body">

    <div class="login-wrapper">
        <div class="container">
        <div class="loginbox">
        <div class="login-left">
        <img class="img-fluid" src="{{ asset('Backend/assets/img/2.jpeg') }}" alt="Logo">
        </div>
        <div class="login-right">
        <div class="login-right-wrap">
        <h1>Welcome to DEMS</h1>
        <!-- <p class="account-subtitle">Need an DEMS account? mail to: <a href="mailto:sandeshthapa5907@gmail.com"></a></p> -->
        <h2>Sign in</h2>

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

        <div class="form-group">
        <label>Email <span class="login-danger">*</span></label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

        <span class="profile-views"><i class="fas fa-user-circle"></i></span>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror



        </div>
        <div class="form-group">
        <label>Password <span class="login-danger">*</span></label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">


        <span class="profile-views feather-eye toggle-password"></span>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        </div>
        <div class="forgotpass">
        <div class="remember-me">
        <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <span class="checkmark"></span>
        </label>
        </div>
        {{-- <a href="forgot-password.html">Forgot Password?</a> --}}
        </div>
        <div class="form-group">
        <button class="btn btn-primary btn-block" type="submit">Login</button>
        </div>
        </form>

        {{-- <div class="login-or">
        <span class="or-line"></span>
        <span class="span-or">or</span>
        </div>

        <div class="social-login">
        <a href="#"><i class="fab fa-google-plus-g"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div> --}}

        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

@endsection

