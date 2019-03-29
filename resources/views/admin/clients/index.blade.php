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
            Projects
            <small>List of available Projects</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="/admin/clients/create"> Add Project</a></li>
            <li class="active">Projects</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col-xs-12">
            
            <!-- /.box -->

            <div class="box">
                <div class="box-header">
                <h3 class="box-title">24Seven Projects</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>View</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($clients as $client)
                        <tr>
                            <td><a href="{{ $client->url }}">{{ $client->name }}</a> </td>
                            <td>
                                <a href="{{ route('clients.show', ['slug' => $client->slug]) }}" class="btn btn-xs btn-primary"><i class = "fa fa-eye"></i> View</a>
                            </td>
                            <td>
                                <a href="{{ route('clients.edit', ['slug' => $client->slug]) }}" class="btn btn-xs btn-success">
                                    <i class = "fa fa-edit"></i> 
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
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