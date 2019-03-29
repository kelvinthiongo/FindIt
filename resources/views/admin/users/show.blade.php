@extends('layouts.admin')
@section('content')
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('layouts.header')
            <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.aside')
            <!-- Content Wrapper. Contains page content -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                  <h1>
                    {{ $user->name }}'s Profile
                  </h1>
                  <ol class="breadcrumb">
                    <li><a href="{{ route('users.index') }}"><i class="fa fa-dashboard"></i> Users</a></li>
                    <li><a href="{{ route('users.index') }}">Admins</a></li>
                    <li class="active">User profile</li>
                  </ol>
                </section>
            
                <!-- Main content -->
                <section class="content">
            
                  <div class="row">
                    <div class="col-md-6">
                      <!-- Profile Image -->
                        <div class="box box-primary" style="height:410px;">
                            <div class="box-body box-profile">
                            <a href="{{ asset($user->avatar) }}">
                              <img class="profile-user-img img-responsive img-circle" src="{{ asset($user->avatar) }}" alt="User profile picture">
                            </a>
            
                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            <ul class="list-group list-group-unbordered">
                              <li class="list-group-item">
                                  <b>Member Since</b> <a class="pull-right">{{ date('F d, Y', strtotime($user->created_at)) }}</a>
                              </li>
                              <li class="list-group-item">
                                  <b>Email</b> <a class="pull-right">{{ $user->email }}</a>
                              </li>
                              <li class="list-group-item">
                                  <b>Phone</b> <a class="pull-right">{{ $user->phone }}</a>
                              </li>
                              <li class="list-group-item">
                                  <b>Users Status</b> <a class="pull-right"> @if($user->type == 'supper') Supper Admin @elseif($user->type == 'ordinary') Ordinary Admin @else User @endif</a>
                              </li>
                            </ul>
                                {!! Form::open(['action' => ['UsersController@destroy', $user->slug], 'method' => 'DELETE']) !!}
                                        @if(Auth::user() == $user)
                                            <button onClick= "javascript: return confirm ('Are you sure you want to exit?');" class="btn btn-danger" type="submit">Exit</button>
                                        @else
                                        <button onClick= "javascript: return confirm ('Are you sure you want to remove {{ $user->name }}?');" class="btn btn-danger" type="submit">Remove</button>
                                        @endif
                                {!! Form::close() !!}
                            </div>
                        <!-- /.box-body -->
                        </div>
                      <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                      <!--edit profile details-->
                      <div class="box box-primary"   style="height:410px;">
                        <div class="box-header with-border">
                          <h3 class="box-title">Edit User Details</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        
                        {!! Form::open(['action' => ['UsersController@update', $user->slug], 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) !!}
                          @csrf
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputPassword1"> Admin Name </label>
                              <input value="{{ $user->name }}" type="text" name = "name" class="form-control" id="exampleInputPassword1" placeholder="Name">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1"> Email address</label>
                              <input value="{{ $user->email }}" type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Phone</label>
                              <input value="{{ $user->phone }}" type="text" class="form-control" id="exampleInputPassword1" placeholder="Phone">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputFile">Change Display Image</label>
                              <input type="file" name="profile" id="exampleInputFile">
                            </div>
                            <!-- Not to be diplayed -->
                            <div class="form-group" style="display: none">
                                <input type="checkbox" name='supper' @if($user->type == 'supper') checked @endif>
                            </div>
                          </div>
                          <!-- /.box-body -->
            
                          <div class="box-footer">
                            <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</button>
                            <a href="{{ route('users.edit', ['slug' => $user->slug]) }}" class="btn btn-primary"><i class="fa fa-eye"></i>show all</a>
                          </div>
                        </form>
                      </div>
                      <!--end edit profile details-->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                </section>
                <!-- /.content -->
            </div>
        <!-- /.content-wrapper -->
        @include('layouts.admin_footer')
        @include('layouts.aside_right')
    </div>
</body>
<!-- ./wrapper -->
@endsection