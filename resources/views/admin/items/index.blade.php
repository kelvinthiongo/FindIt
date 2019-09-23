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
            Documents
          </h1>
          <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Documents</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Uploaded Documents</h3>
                </div>
                @if($items->count() > 0)
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
                        <th>Collection Point</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <ol>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$n = $n + 1}}</td>
                                        <td>{{$item->category}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->number}}</td>
                                        <td>{{$item->collection_point}}</td>
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
                                                    <a href='{{ route('items.edit', $item->id) }}' ><button style="color:green;" class="trans btn btn-success fa fa-edit">Edit</button></a>
                                                </li>
                                                <li class="links">
                                                  <a href='javascript:void(0)' ><button style="color:blue;" class="trans btn btn-success fa fa-check" data-toggle="modal" data-target="{{ '#modal-danger' . $item->id }} ">Mark as collected</button></a>
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
                            <th>Collection Point</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                {{ $items->links() }}
                @else
                <div class="container">
                    <p>There are currently no documents</p>
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

    {{-- Modals --}}
    @foreach ($items as $item)
    <div class="modal fade" id="{{ 'modal-danger' . $item->id }}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{ $item->name . ' ' . $item->number }}</h4>
          </div>
          <div class="modal-body">
            <p>Note that if you mark this document as collected it will be deleted from the database. <br>Are you sure you want to mark it as collected?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            {!! Form::open(['action' => ['ItemsController@destroy',$item->id], 'method' => 'POST', 'id' => 'mark_form']) !!}
                
                <button type="submit" class="trans fa fa-check btn btn-danger">Mark as collected</button>
            
            {!! Form::close() !!}
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    @endforeach
    <!-- /.modal -->


  </div>
  
</body>
@endsection