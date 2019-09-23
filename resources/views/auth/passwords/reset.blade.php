@extends('layouts.admin')
@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="/"> <img src="{{asset('JKUAT.png')}}" alt="Jkuat"> </a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">reset password here</p>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group has-feedback">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter New Password" required>
                </div>
                <div class="form-group has-feedback">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                </div>


                <div class="row">

                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat"> {{ __('Reset Password') }}</button>
                    </div>
                    <!-- /.col -->
                </div>

            </form>

      </div>


@endsection
