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
               Add a new User
                <small>Add a New User Here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="#">Users</a></li>
                <li class="active">New User</li>
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
                    <h3 class="box-title fa fa-plus">Add User</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['action' => 'UsersController@store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Enter Name') }} <span style = "color: red">*</span>
                            {{ Form::text('name', '', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter Name of the User Here']) }} <br>
                            {{ Form::label('email', 'Enter Email') }} <span style = "color: red">*</span>
                            {{ Form::text('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter Email of the User Here']) }} <br>
                            {{ Form::label('phone', 'Enter Phone Number') }} <span style = "color: red">*</span>
                            {{ Form::text('phone', '', ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Enter Phone Number of the User Here']) }} <br>
                            <div class="form-group ">
                                <input type="checkbox" name='is_verified'>
                                <label>Mark as Verified</label>
                            </div>
                            <br>
                        </div>
                      <div class="box-footer">
                        {{ Form::submit('Add User', ['class' => 'btn btn-primary']) }}
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