@extends('client.layouts.app')
@section('content')
    <section class="subheader">
        <div class="container">
            <h1>View Profile</h1>
            <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="/" class="current">View Profile</a></div>
            <div class="clear"></div>
        </div>
    </section>
  
    <section class="module favorited-properties">
        <div class="container">
            <div class="row">
                @include('client.include.user_menu')
                <div class="col-lg-9 col-md-9">
                    {!! Form::open(['action' => ['PagesController@update_profile'], 'method' => 'post']) !!}
                        @csrf
                        <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="form-block">
                                    <label>Full Name</label>
                                    <input class="border" type="text" name="name" value="{{ Auth::user()->name }}" required/>
                                </div>
                                <div class="form-block">
                                    <label>Email(If you changed you will have to verify your account again!</label>
                                    <input class="border" type="text" name="email" value="{{ Auth::user()->email }}" required/>
                                </div>
                                <div class="form-block">
                                    <label>Phone</label>
                                    <input class="border" type="text" name="phone" value="{{ Auth::user()->phone }}" required/>
                                </div>
                            </div>
                        </div><!-- end row -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <h4>Change Password</h4>
                                <div class="divider"></div>
                                <div class="form-block">
                                    <label>{{ __('Current Password') }}</label>
                                    <input class="border{{ $errors->has('current_password') ? ' is-invalid' : '' }}" type="password" name="current_password"/>
                                    @if ($errors->has('current_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $errors->first('current_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-block">
                                    <label>{{ __('New Password') }}</label>
                                    <input class="border{{ $errors->has('new_password') ? ' is-invalid' : '' }}" type="password" name="new_password" />
                                     @if ($errors->has('new_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-block">
                                    <label>{{ __('Confirm New Password') }}</label>
                                    <input class="border{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" type="password" name="confirm_password" />
                                     @if ($errors->has('confirm_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $errors->first('confirm_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div><!-- end row -->
                        
                        <div class="form-block">
                            <button type="submit" class="button button-icon"><i class="fa fa-check"></i>Save Changes</button>
                        </div>
                        
                    </form>
                
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection