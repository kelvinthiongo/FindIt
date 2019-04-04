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
            <div class="col-lg-4 col-lg-offset-4"> 
                <p>Don't have an account? <strong><a href="register.html">Register here.</a></strong></p> 
                <form method="post" class="login-form">
                <div class="form-block">
                    <label>Email</label>
                    <input class="border" type="text" name="email" />
                </div>
                <div class="form-block">
                    <label>Password</label>
                    <input class="border" type="password" name="pass" />
                </div>
                <div class="form-block">
                    <label><input type="checkbox" name="remember" />Remember Me</label><br/>
                </div>
                <div class="form-block">
                    <button class="button button-icon" type="submit"><i class="fa fa-angle-right"></i>Login</button>
                </div>
                <div class="divider"></div>
                <p class="note"><a href="#">I don't remember my password.</a> </p>    
                </form>
            </div>
            </div><!-- end row -->
        
        </div>
    </section>
@endsection 