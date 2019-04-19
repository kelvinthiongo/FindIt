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
               {{ $user->name }}
                <small>Fields with asterik(<span style = "color: red">*</span>) are mandatory</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#">Admins</a></li>
                <li class="active">New Admin</li>
            </ol>
            </section>
            <!-- Main content -->
            <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title fa fa-pencil">Edit {{ $user->name }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                   {!! Form::open(['action' => ['UsersController@update', $user->slug], 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Enter Name') }} <span style = "color: red">*</span>
                            {{ Form::text('name', $user->name, ['class' => 'form-control', 'id' => 'name']) }} <br>
                            
                            {{ Form::label('email', 'Enter Email') }} <span style = "color: red">*</span>
                            {{ Form::text('email', $user->email, ['class' => 'form-control', 'id' => 'email']) }} <br>
                            
                            {{ Form::label('password', 'Type Password ONLY IF You Need To Change!') }}
                            {{ Form::text('password','', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Type the new password here']) }} <br>
                            
                            {{ Form::label('confirm_password', 'Confirm Password ONLY IF You Need To Change!') }}
                            {{ Form::text('confirm_password','', ['class' => 'form-control', 'id' => 'confirm_password', 'placeholder' => 'Confirm password']) }} <br>
                            
                            {{ Form::label('phone', 'Enter Phone Number') }} 
                            {{ Form::text('phone', $user->phone, ['class' => 'form-control', 'id' => 'phone',]) }} <br>
                            
                            @if(Auth::user()->type == 'supper' && $user->type != 'user')
                                <div class="form-group ">
                                    <input type="checkbox" name='supper' @if($user->type == 'supper') checked @endif>
                                    <label>Make supper admin</label>
                                </div>
                            @endif
                            @if(Auth::user()->type != 'user')
                                <div class="form-group ">
                                    <input type="checkbox" name='is_verified' @if($user->is_verified) checked @endif>
                                    <label>Mark as verified</label>
                                </div>
                            @endif

                            {{ Form::label('avatar', 'Upload an avatar') }}
                            {{ Form::file('avatar', ['class' => 'form-control']) }} <br>
                        </div>
                      <div class="box-footer">
                        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                      </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.box -->
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