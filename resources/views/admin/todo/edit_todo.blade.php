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
               Edit Todo
                <small>Edit this Item Here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Edit Todo</li>
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
                    <h3 class="box-title fa fa-plus">Edit Todo Item</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['action' => ['HomeController@update', $todo->id], 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
                          <div class="box-body">
                                <div class="form-group col-sm-12">
                                    {{ Form::label('Duration','',['class'=>'col-sm-2 control-label']) }}
    
                                    <div class="row col-sm-10">
                                    <div class="col-sm-6">
                                        {{Form::number('duration' ,$todo->duration, ['step'=>'1','class' => 'form-control col-sm-5','placeholder' => 'Eg. 1,2,7,11']) }}
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="measure" class="form-control">
                                            <option value = '{{$todo->measure}}' >{{$todo->measure}}</option>
                                            <option value = 'day(s)' >Day</option>
                                            <option value = 'week(s)' >week</option>
                                            <option value = 'hour(s)' >Hour</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    {{ Form::label('Description','',['class'=>'col-sm-2 control-label']) }}
    
                                    <div class="row col-sm-10">
                                        <div class="col-sm-12">
                                            {{Form::text('description' ,$todo->description,['class' => 'form-control','placeholder' => 'Eg. Create a Project']) }}
                                        </div>
                                    </div>
                                </div>
                                {{ Form::hidden('_method','PUT')}}
                          <div class="box-footer">
                              {{ Form::button('Edit item',['class'=>'btn btn-success fa fa-pencil pull-right','type'=>'submit']) }}
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