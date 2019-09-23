
@extends('layouts.admin')
@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="/"> <img src="{{asset('jkuat.png')}}" alt="Jkuat"> </a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Enter email here to reset password</p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf


                <div class="form-group has-feedback">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required >
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>


                <div class="row">

                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">  {{ __('Send Password Reset Link') }}</button>
                    </div>
                    <!-- /.col -->
                </div>

            </form>

      </div>


@endsection
