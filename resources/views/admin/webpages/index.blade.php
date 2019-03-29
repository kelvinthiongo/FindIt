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
            Pages
            <small>Available Pages</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="/admin/webpages/create"><i class="fa fa-plus"></i>Add Page</a></li>
            <li class="active">Pages</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Available Pages</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(count($pages) > 0)
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            <th>Page</th>
                            <th>Edit</th>
                            <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $page)
                                    <tr>
                                        <td>{{$page->name}}</td>
                                        <td>
                                            <a href='/admin/webpages/{{$page->id}}/edit' ><button class="btn btn-success fa fa-pencil"> Edit Page Name</button></a>
                                        </td>
                                        <td>
                                            {!! Form::open(['action' => ['WebpagesController@destroy',$page->id], 'method' => 'POST','onsubmit' => 'return ConfirmDelete()']) !!}
                                                {{ Form::hidden('_method','DELETE')}}
                                                
                                                {{ Form::submit('Delete',['class'=>'btn btn-danger']) }}
                                            
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Page</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr>
                            </tfoot>
                        </table>
                    @else
                        <p>There are no Pages to display</p>
                    @endif
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
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
@endsection