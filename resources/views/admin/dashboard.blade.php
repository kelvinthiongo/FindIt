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
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
              <h3>{{ $admins }}</h3>

                <p>Admins</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="/admin/admins" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col 1-->
          <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
              <h3>{{ $users }}</h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="/admin/users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col 2-->
          <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{ $approved_items }}</h3>
  
                  <p>Approved Items</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="/admin/approved-items" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{ $pending_items }}</h3>
                <p>Pending Items</p>
              </div>
              <div class="icon">
                <i class="fa fa-id-card"></i>
              </div>
              <a href="/admin/pending-items" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col 3-->
          <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3>{{ $trashed_items }}</h3>
                <p>Trashed Items</p>
              </div>
              <div class="icon">
                <i class="fa fa-id-card"></i>
              </div>
              <a href="/admin/trashed-items" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col 4-->
          <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <h3>{{ $reported_items }}</h3>
                <p>Reported Items</p>
              </div>
              <div class="icon">
                <i class="fa fa-id-card"></i>
              </div>
              <a href="javascript void()" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col 5-->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- TO DO List -->
            <div class="box box-primary">
              <div class="box-header">
                <i class="ion ion-clipboard"></i>

                <h3 class="box-title">To Do List</h3>
                <div class="box-tools pull-right">
                  <ul class="pagination pagination-sm inline">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.box-header -->
              @if(count($todos) > 0)
                @foreach($todos as $todo)
                <div class="box-body">
                  <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                  <ul class="todo-list">
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                      <input type="checkbox" value="">
                      <!-- todo text -->
                      <span class="text">{{$todo->description}}</span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i> {{$todo->duration . $todo->measure}}</small>
                      
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <table>
                          <tr>
                            <td> <a href="/admin/todo/{{$todo->id}}/edit"><button class="btn btn-success fa fa-edit"> Edit</button></a> </td>
                            <td>
                                {!! Form::open(['action' => ['HomeController@destroy',$todo->id], 'method' => 'POST','onsubmit' => 'return ConfirmDelete()']) !!}
                                {{ Form::hidden('_method','DELETE')}}
                                
                                {{ Form::button('Delete',['type'=>'submit','class'=>' pull-right btn btn-danger fa fa-trash']) }}
                            
                              {!! Form::close() !!}
                            </td>
                          </tr>
                        </table>
                      </div>
                    </li>
                  </ul>
                </div>
                @endforeach
              @else
                <p>Your Todo List is Empty</p>
              @endif
              <!-- /.box-body -->
              <div class="box-footer clearfix no-border">
                <a href="/admin/todo/create" ><button type="button" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add item</button></a>
                
              </div>
            </div>
            <!-- /.box -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-12 connectedSortable">
            <!-- Calendar -->
            <div class="box box-solid bg-green-gradient">
              <div class="box-header">
                <i class="fa fa-calendar"></i>

                <h3 class="box-title">Calendar</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <!-- button with a dropdown -->
                  <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
            </div>
            <!-- /.box -->

          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('layouts.admin_footer')
    @include('layouts.aside_right')
  </div>
</body>
@endsection