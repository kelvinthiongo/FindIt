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
            {{ $user_type }}s
            <small>List of available @if($user_type == 'Admin')admins @else users @endif</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">{{ $user_type }}s Details</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col-xs-12">
            
            <!-- /.box -->

            <div class="box">
                <div class="box-header">
                <h3 class="box-title">View all {{ $user_type }}s</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>View</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }} @if($user->type == 'supper') (<span style="color: blue">supper</span>) @endif</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.show', ['slug' => $user->slug]) }}" class="btn btn-xs btn-primary">View</a>
                            </td>
                            <td>
                                <a href="{{ route('users.edit', ['slug' => $user->slug]) }}" class="btn btn-xs  btn-success @if(Auth::user()->type == 'supper' || Auth::user()->id == $user->id || $user->type == 'user') @else disabled @endif">
                                    <i class = "fa fa-pencil"></i> 
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>View</th>
                        <th>Edit</th>
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