@extends('layouts.admin')
@section('content')

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('layouts.header')
        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.aside')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Categories
                    <small>View all Categories</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/home"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">View Categories</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Available Categories</h3>

                                <div class="box-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control pull-right"
                                            placeholder="Search">

                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    @if(count($categories) > 0)
                                        <thead>
                                            <tr>
                                            <th>Title</th>
                                            <th>Edit</th>
                                            <th>Remove</th>
                                            </tr>
                                        </thead>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{$category->name}}</td>
                                                <td><a href="{{ route('categories.edit', ['slug' => $category->slug]) }}" class="btn success"><i class="fa fa-edit"></i> Edit</a></td>
                                                <td>
                                                    {!! Form::open(['action' => ['CategoriesController@destroy',$category->slug], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                        {{ Form::hidden('_method' ,'DELETE')}}
                                                        {{ Form::submit('Remove',['class'=>'btn btn-danger btn-sm fa fa-trash']) }}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p>There are no categories to display</p>
                                    @endif
                                    
                                </table>
                               
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.admin_footer')
        @include('layouts.aside_right')
    </div>
</body>
@endsection