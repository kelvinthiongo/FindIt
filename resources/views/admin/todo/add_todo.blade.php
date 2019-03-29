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
                    Todo list
                    <small>Add New</small>
                  </h1>
                  <ol class="breadcrumb">
                    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Add an Activity</li>
                  </ol>
                </section>
            
                <!-- Main content -->
                <section class="content">
                  <!-- Horizontal Form -->
                  <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">New Todo Item</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['action' => 'HomeController@store', 'method' => 'POST']) !!}
                        <div class="box-body">
                          <div class="form-group col-sm-12">
                              {{ Form::label('Duration','',['class'=>'col-sm-2 control-label']) }}

                              <div class="row col-sm-10">
                                <div class="col-sm-6">
                                    {{Form::number('duration' ,'', ['step'=>'1','class' => 'form-control col-sm-5','placeholder' => 'Eg. 1,2,7,11']) }}
                                </div>
                                <div class="col-sm-6">
                                  <select name="measure" class="form-control">
                                      <option value = '' >-- eg min/day/hr/week --</option>
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
                                    {{Form::text('description' ,'',['class' => 'form-control','placeholder' => 'Eg. Create a Project']) }}
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="box-footer">
                            {{ Form::button('Add item',['class'=>'btn btn-success fa fa-plus pull-right','type'=>'submit']) }}
                        </div>
                    {!! Form::close() !!}
                  </div>
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