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
                    Edit Document
                    <small>Edit the details of the document Here</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="#">Documents</a></li>
                    <li class="active">New Upload</li>
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
                                <h3 class="box-title fa fa-plus">Edit Document</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form method="post" action="{{ route('item.update', $item->id) }}" accept-charset="UTF-8">
                                @csrf
                                <div class="form-group">
                                    {{ Form::label('name', 'Enter Name') }}
                                    {{ Form::text('name', $item->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter Name as it is on the Document']) }}
                                    <br>
                                    {{ Form::label('number', 'Document Number') }}
                                    {{ Form::text('number', $item->number, ['class' => 'form-control', 'id' => 'number', 'placeholder' => 'Enter Document Number']) }}
                                    <br>
                                    {{ Form::label('category_id', 'Select Category') }} <span
                                        style="color: red">*</span>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="{{ $item->category_id }}">{{ $item->category }}</option>
                                        @foreach ($categories as $category)
                                        @if ($item->category_id != $category->id)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                        @endforeach
                                    </select><br>
                                    {{ Form::label('collection_point', 'Collection Point') }} <span style = "color: red">*</span>
                                    {{ Form::text('collection_point', $item->collection_point, ['class' => 'form-control', 'id' => 'collection_point', 'placeholder' => 'Enter Collection Point']) }} <br>
                                    <br>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                        Save</button>
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