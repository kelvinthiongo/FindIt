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
            approved Items
            <small>Items already Approved</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/pending-items"><i class="fa fa-check"></i>Pending Items</a></li>
            <li class="active">approved Items</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">approved Items</h3>
                </div>
                @if($approved_items->count() > 0)
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
                        @if (Auth::user()->type == 'supper')
                            <th>Approved By</th>
                        @endif
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <ol>
                                @foreach($approved_items as $approved)
                                    <tr>
                                        <td>{{$n = $n + 1}}</td>
                                        <td>{{$approved->category}}</td>
                                        <td>{{$approved->f_name." ".$approved->s_name." ".$approved->l_name}}</td>
                                        <td>{{$approved->number}}</td>
                                        @if (Auth::user()->type == 'supper')
                                          <td>{{$names[$approved->approved]}}</td>
                                        @endif
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
                                                <a href="/admin/approved-items/{{$approved->id}}/disapprove" ><button style="color:green;" class="trans btn btn-success fa fa-thumbs-down"> </button></a>
                                                </li>
                                                <li class="links">
                                                    <a target="_blank" href='/items/{{$approved->slug}}' ><button style="color:green;" class="trans btn btn-success fa fa-eye"> </button></a>
                                                </li>
                                                <li class="links">
                                                    <a target="_blank" href='/items/{{$approved->slug}}/edit' ><button style="color:green;" class="trans btn btn-success fa fa-edit"> </button></a>
                                                </li>
                                                <li class="links">
                                                    {!! Form::open(['action' => ['ItemsController@destroy',$approved->slug], 'method' => 'POST','onsubmit' => 'return ConfirmDelete()']) !!}
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
                            @if (Auth::user()->type == 'supper')
                              <th>Approved By</th>
                            @endif
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                @else
                <div class="container">
                    <p>There are currently no approved items</p>
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