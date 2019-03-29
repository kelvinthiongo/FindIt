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
                    24 Seven Partners
                    <small>View 24 seven Partners</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/home"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li><a href="/admin/partners/create">Add Partner</a></li>
                    <li class="active" href="/partner/create">View Partner</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Current Partners</h3>

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
                                    @if(count($partners) > 0)
                                    <tr>
                                        <th>Partner Logo</th>
                                        <th>Link to Website</th>
                                        <th>Partner Name</th>
                                        <th>Visit Partner Website</th>
                                    </tr>
                                        @foreach($partners as $partner)
                                            <tr>
                                                <td><img src="{{ asset($partner->logo) }}" alt="logo"></td>
                                                <td>{{$partner->link}}</td>
                                                <td>{{$partner->name}}</td>
                                                <td>
                                                    <a target="_blank" href='{{ $partner->link }}' ><button class="btn btn-primary fa fa-globe">Visit</button></a>
                                                </td>
                                                <td>
                                                    <a href='/admin/partners/{{$partner->id}}/edit' ><button class="btn btn-success fa fa-pencil"> Edit</button></a>
                                                </td>
                                                <!--<td><button  type="button" class="btn btn-success fa fa-edit" data-toggle="modal" data-target="#modal-default">
                                                    Edit
                                                </button></td>-->
                                                <td>
                                                    {!! Form::open(['action' => ['PartnersController@destroy',$partner->id], 'method' => 'POST','onsubmit' => 'return ConfirmDelete()']) !!}
                                                        {{ Form::hidden('_method','DELETE')}}
                                                        
                                                        {{ Form::button('Delete',['class'=>'btn btn-danger fa fa-trash','type'=>'submit']) }}
                                                 
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p>There are no partners to display</p>
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