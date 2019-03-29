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
            Trashed {{ $user_type }}s
            <small>List of trashed @if($user_type == 'Admin')admins @else users @endif</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">{{ $user_type }} Details</a></li>
            <li class="active">Data tables</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col-xs-12">
            
            <!-- /.box -->

            <div class="box">
                <div class="box-header">
                <h3 class="box-title">View all Trashed {{ $user_type }}s</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Restore</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }} @if(Auth::user()->type == 'supper') (<span style="color: blue">supper</span>) @endif</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {!! Form::open(['action' => ['UsersController@restore', $user->slug], 'method' => 'POST']) !!}
                                    @csrf
                                    <button class="btn btn-success @if(Auth::user()->type == 'supper' || Auth::user()->id == $user->id || $user->type == 'user') @else disabled @endif"><i class = "fa fa-undo"></i> Restore</button>
                                {!! Form::close() !!}
                            </td>
                            <td>
                                {!! Form::open(['action' => ['UsersController@p_destroy', $user->slug], 'method' => 'DELETE']) !!}
                                        <button onClick= "javascript: return confirm ('Are you sure you want to remove {{ $user->name }}?');" class="btn btn-danger @if(Auth::user()->type == 'supper' || Auth::user()->id == $user->id || $user->type == 'user') @else disabled @endif" type="submit"><i class="fa fa-trash"></i>Delete</button>
                                {!! Form::close() !!}
                            </td>
                            
                        </tr>
                    @endforeach
                    
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Restore</th>
                        <th>Delete</th>
                    </tr>
                    </tfoot>
                </table>
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