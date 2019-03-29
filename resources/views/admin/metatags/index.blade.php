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
            Meta Tags
            <small>Available metatags</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/metatags/create"><i class="fa fa-plus"></i>Add Meta Tag</a></li>
            <li class="active">Meta Tags</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Available Meta Tags</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(count($tags) > 0)
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            <th>Page</th>
                            <th>Meta Tag Name</th>
                            <th>Meta Tag Content</th>
                            <th>Edit Meta Tag</th>
                            <th>Remove Meta Tag</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{$tag->page}}</td>
                                        <td>{{$tag->name}}</td>
                                        <td>{{$tag->content}}</td>
                                        <td>
                                            <a href='/admin/metatags/{{$tag->id}}/edit' ><button class="btn btn-success fa fa-pencil"> Edit</button></a>
                                        </td>
                                        <td>
                                            {!! Form::open(['action' => ['MetatagsController@destroy',$tag->id], 'method' => 'POST','onsubmit' => 'return ConfirmDelete()']) !!}
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
                                <th>Meta Tag Name</th>
                                <th>Meta Tag Content</th>
                                <th>Edit Meta Tag</th>
                                <th>Remove Meta Tag</th>
                            </tr>
                            </tfoot>
                        </table>
                    @else
                        <p>There are no meta tags to display</p>
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