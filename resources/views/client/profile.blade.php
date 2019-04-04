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
                    <form>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="edit-avatar">
                                    <img class="profile-avatar" src="{{ asset('client/images/agent-img3.jpg') }}" alt="" />
                                    <a href="#" class="button small">Change Avatar</a>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                
                                <div class="form-block">
                                    <label>Full Name</label>
                                    <input class="border" type="text" name="name" value="John Doe" />
                                </div>
                                <div class="form-block">
                                    <label>Email</label>
                                    <input class="border" type="text" name="email" value="jdoe@gmail.com" />
                                </div>
                                <div class="form-block">
                                    <label>Phone</label>
                                    <input class="border" type="text" name="phone" value="443-123-2322" />
                                </div>
                            </div>
                        </div><!-- end row -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <h4>Change Password</h4>
                                <div class="divider"></div>
                                <div class="form-block">
                                    <label>Current Password</label>
                                    <input class="border" type="text" name="current_pass" />
                                </div>
                                
                                <div class="form-block">
                                    <label>New Password</label>
                                    <input class="border" type="text" name="new_pass" />
                                </div>
                                
                                <div class="form-block">
                                    <label>Confirm New Password</label>
                                    <input class="border" type="text" name="new_pass_confirm" />
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