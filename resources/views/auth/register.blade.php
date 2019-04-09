@extends('client.layouts.app')
@section('content')
    <section class="subheader">
        <div class="container">
            <h1>Register</h1>
            <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="/" class="current">Register</a></div>
            <div class="clear"></div>
        </div>
    </section>
    <section class="module login">
        <div class="container">
    
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-lg-offset-4"> 
            <p>Already have an account? <strong><a href="/login">Login here.</a></strong></p> 
            <form class="login-form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-block">
                    <label>{{ __('Name') }}</label>
                    <input id="name" type="text" class="border{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus/>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{ $errors->first('name') }}</strong>
                        </span>
                        <br><br>
                    @endif
                </div>
                <div class="form-block">
                    <label>{{ __('Email') }}</label>
                    <input id="email" type="email" class="border{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required/>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{ $errors->first('email') }}</strong>
                        </span>
                        <br><br>
                    @endif
                </div>
                <div class="form-block">
                    <label>{{ __('Phone') }}</label>
                    <input id="phone" type="text" class="border{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required/>
                    
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-block">
                    <label>{{ __('Password') }}</label>
                    <input id="password" type="password" class="border{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required/>
                    
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-block">
                    <label>{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="border" name="password_confirmation" required/>
                </div>
                <div class="form-block">
                    <button class="button button-icon" type="submit"><i class="fa fa-angle-right"></i>{{ __('Register') }}</button>
                </div>
                <div class="divider"></div>
                <p class="note">By clicking the "Register" button you agree with our <a href="/terms-and-policy">Terms and conditions</a></p>    
            </form>
            </div>
        </div><!-- end row -->
    
        </div>
    </section>
@endsection 