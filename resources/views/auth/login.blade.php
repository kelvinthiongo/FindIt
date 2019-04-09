@extends('client.layouts.app')
@section('content')
    <section class="subheader">
        <div class="container">
            <h1>Login</h1>
            <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="/" class="current">Login</a></div>
            <div class="clear"></div>
        </div>
    </section>
    <section class="module login">
        <div class="container">
            <div class="row">
            <div class="col-md-4 col-md-offset-4 col-lg-offset-4"> 
                <p>Don't have an account? <strong><a href="/register">Register here.</a></strong></p> 
                <form method="post" class="login-form" action="{{ route('login') }}">
                    @csrf
                    <div class="form-block has-feedback">
                        <label>Email</label>
                        <input class="border{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" required/>
                        @if ($errors->has('email'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                {{ $errors->first('email') }}
                            </div>

                        @endif
                    </div>
                    <div class="form-block has-feedback">
                        <label>Password</label>
                        <input class="border{{ $errors->has('password') ? ' is-invalid' : '' }}"  id="password" type="password" name="password" required/>
                        
                        @if ($errors->has('password'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    
                    </div>
                    <div class="form-block">
                        <label><input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}/>Remember Me</label><br/>
                    </div>
                    <div class="form-block">
                        <button class="button button-icon" type="submit"><i class="fa fa-angle-right"></i>Login</button>
                    </div>
                    <div class="divider"></div>
                    <p class="note"><a href="{{ route('password.request') }}">I don't remember my password.</a> </p>    
                </form>
            </div>
            </div><!-- end row -->
        
        </div>
    </section>
@endsection 