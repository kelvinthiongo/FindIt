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
               Add a new Partner
                <small>Add a New Partner Here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/partners">Partners</a></li>
                <li class="active">New Partner</li>
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
                    <h3 class="box-title fa fa-plus">Add Partner</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['action' => 'PartnersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="box-body">
                            <div class="form-group">
                                {{ Form::label('Website URL') }}

                                {{Form::text('url' ,'', ['class' => 'form-control','id' => 'exampleInputEmail1', 'placeholder' => 'Enter Website URL Here']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Partner Name') }}

                                {{Form::text('name' ,'', ['class' => 'form-control','id' => 'exampleInputEmail1', 'placeholder' => 'Enter Partner Name Here']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('title') }}

                                {{ Form::file('logo')}}
                            </div>
                        </div>
                        <div class="box-footer">
                            {{ Form::submit('Add Partner',['class'=>'btn btn-primary']) }}
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