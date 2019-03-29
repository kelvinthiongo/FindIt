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
               Add a new Client
                <small>Fields with an asterik(<span style = "color: red">*</span>) are mandatory</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ route('clients.index') }}">Projects</a></li>
                <li class="active">New Project</li>
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
                    <h3 class="box-title fa fa-plus">Add Project</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['action' => 'ClientsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Name of the Client\'s site') }} <span style = "color: red">*</span>
                            {{ Form::text('name', '', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter Name of the Client Here']) }} <br>
                            
                            {{ Form::label('url', 'Url of the site') }} <span style = "color: red">*</span>
                            {{ Form::text('url', '', ['class' => 'form-control', 'id' => 'url', 'placeholder' => 'Enter Url of the Site Here']) }} <br>
                            
                            {{ Form::label('phone', 'Phone Number of the Client') }}
                            {{ Form::text('phone', '', ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Enter Phone Number of the Client Here']) }} <br>
                            
                            {{ Form::label('source_code_link', 'Source Code Link') }}
                            {{ Form::text('source_code_link', '', ['class' => 'form-control', 'id' => 'source_code_link', 'placeholder' => 'Enter the Source Code Link Here']) }} <br>

                            {{ Form::label('cpanel_username', 'CPanel Username') }}
                            {{ Form::text('cpanel_username', '', ['class' => 'form-control', 'id' => 'cpanel_username', 'placeholder' => 'Enter the CPanel Username Here']) }} <br>
                            
                            {{ Form::label('cpanel_password', 'CPanel Password') }}
                            {{ Form::text('cpanel_password', '', ['class' => 'form-control', 'id' => 'cpanel_password', 'placeholder' => 'Enter the CPanel Password Here']) }} <br>

                            {{ Form::label('admin_username', 'Admin Username') }}
                            {{ Form::text('admin_username', '', ['class' => 'form-control', 'id' => 'admin_username', 'placeholder' => 'Enter Admin Username Here']) }} <br>
                            
                            {{ Form::label('admin_password', 'Admin Password') }}
                            {{ Form::text('admin_password', '', ['class' => 'form-control', 'id' => 'admin_password', 'placeholder' => 'Enter Admin Password Here']) }} <br>

                            {{ Form::label('image', 'Upload an Image') }} <span style = "color: red">*</span>
                            {{ Form::FIle('image') }} <br>
                        </div>
                      <div class="box-footer">
                        {{ Form::submit('Add Client', ['class' => 'btn btn-primary']) }}
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