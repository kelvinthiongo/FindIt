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
            subscribers
            <small>Available subscribers</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="/admin/subscribers/create"><i class="fa fa-plus"></i>Add Subscriber</a></li>
            <li class="active">subscribers</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Available subscribers</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(count($subscribers) > 0)
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            <th>Subscriber's Email</th>
                            <th>Subscriber since</th>
                            <th>Edit Subscriber</th>
                            <th>Remove Subscriber</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($subscribers as $subscriber)
                                    <tr>
                                        <td>{{$subscriber->email}}</td>
                                        <td>{{date('F d, Y', strtotime($subscriber->created_at))}}</td>
                                        <td>
                                            <a href='/admin/subscribers/{{$subscriber->id}}/edit' ><button class="btn btn-success fa fa-pencil"> Edit</button></a>
                                        </td>
                                        <td>
                                            {!! Form::open(['action' => ['SubscribersController@destroy',$subscriber->id], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {{ Form::hidden('_method' ,'DELETE')}}
                                                
                                                {{ Form::submit('Remove',['class'=>'btn btn-danger']) }}
                                            
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Subscriber's Email</th>
                                <th>Subscriber since</th>
                                <th>Edit Subscriber</th>
                                <th>Remove Subscriber</th>
                            </tr>
                            </tfoot>
                        </table>
                    @else
                        <p>There are no subscribers to display</p>
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