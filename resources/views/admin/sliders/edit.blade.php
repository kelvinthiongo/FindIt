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
               Edit a new Slider
                <small>Fields with an asterik(<span style = "color:red;">*</span>) are mandatory</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{ route('sliders.index') }}">Sliders</a></li>
                <li class="active">Edit Slider</li>
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
                    <h3 class="box-title fa fa-plus">Edit Slider</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['action' => ['SlidersController@update', 'slug' => $slider->slug], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {{ Form::label('title', 'Title') }} <span style = "color: red">*</span>
                            {{ Form::text('title', $slider->title, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter Title of the Slider Here']) }} <br>
                            
                            {{ Form::label('message', 'Message') }} <span style = "color: red">*</span>
                            {{ Form::text('message', $slider->message, ['class' => 'form-control', 'id' => 'message', 'placeholder' => 'Enter Message on the Slider Here']) }} <br>
                            
                            {{ Form::label('link_message', 'Link Message') }} <span style = "color: red">*</span>
                            {{ Form::text('link_message', $slider->link_message, ['class' => 'form-control', 'id' => 'link_message', 'placeholder' => 'Enter Link Message Here']) }} <br>
                            
                            {{ Form::label('link', 'Link') }} <span style = "color: red">*</span>
                            {{ Form::text('link', $slider->link, ['class' => 'form-control', 'id' => 'link', 'placeholder' => 'Enter the Link Here']) }} <br>

                            {{ Form::label('image', 'Upload an Image') }}
                            {{ Form::FIle('image') }} <br>
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