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
            Pending Items
            <small>Items awaiting Approval</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/items/pending"><i class="fa fa-check"></i>Approved Items</a></li>
            <li class="active">Pending Items</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Pending Items</h3>
                </div>
                @if($pendings->count() > 0)
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped">
                        <div style="display:none">{{$n = 0}}</div>
                        <thead>
                        <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <ol>
                                @foreach($pendings as $pending)
                                    <tr>
                                        <td>{{$n = $n + 1}}</td>
                                        <td>{{$pending->category->name}}</td>
                                        <td>{{$pending->name}}</td>
                                        <td>{{$pending->number}}</td>
                                        <td>
                                            <style>
                                                .trans{
                                                    background-color:transparent;
                                                    border:0px;
                                                    color:red;
                                                }
                                                #action li {
                                                    display:inline-block;
                                                }
                                            </style>
                                            <ul id="action" style="list-style-type:none;">
                                                <li class="links">
                                                    <a href='/admin/pending-items/{{$pending->id}}/approve' ><button style="color:green;" class="trans btn btn-success fa fa-check"> </button></a>
                                                </li>
                                                <li class="links">
                                                    <a target="_blank" href='/items/{{$pending->slug}}/edit' ><button style="color:green;" class="trans btn btn-success fa fa-edit"> </button></a>
                                                </li>
                                                <li class="links">
                                                    <a target="_blank" href='/items/{{$pending->slug}}' ><button style="color:green;" class="trans btn btn-success fa fa-eye"> </button></a>
                                                </li>
                                                <li class="links">
                                                    {!! Form::open(['action' => ['ItemsController@destroy',$pending->slug], 'method' => 'POST','onsubmit' => 'return ConfirmDelete()']) !!}
                                                        {{ Form::hidden('_method','DELETE')}}
                                                        
                                                        {{ Form::button('',['class'=>'trans fa fa-trash btn btn-danger', 'type'=>'submit']) }}
                                                    
                                                    {!! Form::close() !!}
                                                </li>
                                            </ul>
                                                
                                        </td>
                        
                                    </tr> 
                                @endforeach
                            </ol>
                            
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                @else
                <div class="container">
                    <p>There are currently no items awaiting approval</p>
                </div>
                @endif
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