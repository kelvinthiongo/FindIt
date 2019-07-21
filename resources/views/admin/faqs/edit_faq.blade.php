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
               Edit faq
                <small>Edit faq Here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/faqs">faqs</a></li>
                <li class="active">Edit faq</li>
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
                    <h3 class="box-title fa fa-plus">Edit faq</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['action' => ['FaqController@update', $faq->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                        <div class="box-body">
                            <div class="form-group">
                                {{ Form::label('Queston') }}

                                {{Form::text('question' ,$faq->question, ['class' => 'form-control','id' => 'exampleInputEmail1', 'placeholder' => 'Enter the faq']) }}
                            </div>
                            <div class="form-group">
                                    {{ Form::label('Answer') }}
    
                                    {{Form::textarea('answer' ,$faq->answer, ['class' => 'form-control','id' => 'exampleInputEmail1', 'placeholder' => 'Enter the answer to the faq above']) }}
                            </div>
                        </div>
                        <div class="box-footer">
                            {{ Form::button('Update faq',['class'=>'fa fa-edit btn btn-primary', 'type'=>'submit']) }}
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