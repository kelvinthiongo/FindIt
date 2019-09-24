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
                    {{ $item_status }} Documents
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">{{ $item_status }} Documents</li>
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
                                            <th>Upload Date</th>
                                            <th>Collected</th>
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
                                                <td>{{date('jS, M Y', strtotime($item->created_at))}}</td>
                                                <td>
                                                    <input type="checkbox" id="mark{{$item->id}}"
                                                        onchange="mark({{ $item->id }})" {{ $item->collected? 'checked': '' }}>
                                                        @if ($item->collected)
                                                            {{date('jS, M Y', strtotime($item->collected))}}
                                                        @endif
                                                </td>
                                                <td>
                                                    <style>
                                                        .trans {
                                                            background-color: transparent;
                                                            border: 0px;
                                                            color: red;
                                                        }

                                                        #action li {
                                                            display: inline-block;
                                                        }
                                                    </style>
                                                    <ul id="action" style="list-style-type:none;">
                                                        <li class="links">
                                                            <a href='{{ route('items.edit', $item->id) }}'><button
                                                                    style="color:green;"
                                                                    class="trans btn btn-success fa fa-edit">Edit</button></a>
                                                        </li>
                                                        <li class="links">
                                                            <a href='javascript:void(0)'><button
                                                                    class="trans btn btn-danger fa fa-check"
                                                                    data-toggle="modal"
                                                                    data-target="{{ '#modal-danger' . $item->id }} ">Delete</button></a>
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
                                            <th>Upload Date</th>
                                            <th>Collected</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            {{ $items->links() }}
                            @else
                            <div class="container">
                                <p>There are currently no {{ $item_status }} documents</p>
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
                        <p>Are you sure you want to remove this record?<br> This action cannot be undone onece confirmed!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        {!! Form::open(['action' => ['ItemsController@destroy',$item->id], 'method' => 'POST', 'id' =>
                        'mark_form']) !!}

                        <button type="submit" class="fa fa-trash btn btn-danger"> Remove</button>

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
    <script>
        function mark(id) {
            if($('#mark'+id).prop("checked") == true){
                var checked = true;
            }
            else{
                var checked = false;
            }
            if(!ConfirmMark(checked)){
                location.reload();
                return null;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/item/mark-as-collected/"+id,
                type: "POST",
                data: {
                    checked: checked
                },
                success: function( data ) {
                    toastr.success('Update successful!', 'Success here');
                },
                error: function(){
                    toastr.error('An error occured, try again.', 'Task failed');
                    location.reload();
                }
            });
        }
    </script>
</body>
@endsection
