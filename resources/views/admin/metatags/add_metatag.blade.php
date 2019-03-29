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
               Add a Meta Tag
                <small>Add a New Meta Tag Here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/metatags">Meta Tags</a></li>
                <li class="active">New Meta Tag</li>
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
                    <h3 class="box-title fa fa-plus">Add Meta Tag</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['action' => 'MetatagsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="box-body">
                            <div class="form-group">
                                {{ Form::label('Page','Page') }}
                                <select name="page" class="form-control">
                                    <option value = '' >--Select Page--</option>
                                    @foreach($pages as $page)
                                        <option value = '{{$page->name}}' >{{$page->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                {{ Form::label('Name') }}

                                {{Form::text('name' ,'', ['class' => 'form-control','id' => 'exampleInputEmail1', 'placeholder' => 'Enter the name of the meta tag']) }}
                            </div>
                            <div class="form-group">
                                    {{ Form::label('Content') }}
    
                                    {{Form::text('content' ,'', ['class' => 'form-control','id' => 'exampleInputEmail1', 'placeholder' => 'Enter the content of the meta tag']) }}
                            </div>
                        </div>
                        <div class="box-footer">
                            {{ Form::submit('Add Meta Tag',['class'=>'btn btn-primary']) }}
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