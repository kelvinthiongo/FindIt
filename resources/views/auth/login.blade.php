@extends('layouts.admin')
@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="/"> <img src="{{asset('/JKUAT.png')}}" alt=""> </a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group has-feedback">
                        <label for="">Email</label>
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter login Email" required >
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                </div>

                <div class="form-group has-feedback">
                        <label for="">Password</label>
                        <input id="password" type="password" placeholder="Enter account password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div>
                        <label>
                            <input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}>  Remember me
                        </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
                    </div>
                    <!-- /.col -->
                </div>

            </form>
            <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a><br>
      </div>
                <!-- /.login-box-body -->

@endsection
