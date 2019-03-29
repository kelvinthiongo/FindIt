@extends('layouts.admin')
@section('content')
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('layouts.header')
            <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.aside')
            <!-- Content Wrapper. Contains page content -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                  <h1>
                   Project Details
                  </h1>
                  <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="{{ route('clients.index') }}">All Projects</a></li>
                    <li class="active">Project Name</li>
                  </ol>
                </section>
            
                <!-- Main content -->
                <section class="content">
            
                  <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#screenshot" data-toggle="tab">Project Details</a></li>
                          <li><a href="#cpanel" data-toggle="tab">Cpanel Credentials</a></li>
                          <li><a href="#admin" data-toggle="tab">Admin Credentials</a></li>
                        </ul>
                        <div class="tab-content">
                          <div class="active tab-pane" id="screenshot">
                            <div class="box-body">
                                <table  class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td><a href="{{ route('clients.edit', ['slug' => $client->slug]) }}" class="btn btn-primary ">
                                                <i class="fa fa-pencil"></i> Edit
                                                </a>
                                            </td>
                                            <td>{!! Form::open(['action' => ['ClientsController@destroy', $client->slug], 'method' => 'POST', 'id' => 'delete_form', 'onsubmit' => 'return confirmDelete()']) !!}
                                                {{ Form::hidden('_method','DELETE')}}
                                        
                                                {{ Form::button(' Delete',['class'=>'btn btn-danger fa fa-trash', 'type' => 'submit']) }}
                                    
                                                {!! Form::close() !!}
                                            </td>
                                            
                                            
                                        </tr>   
                                    </thead>
                                    
                                </table>
                                <div class="row">
                                    
                                    
                                    
                                </div>
                                
                                <script>
                                    function confirmDelete(){
                                        var x = confirm("Are you sure you want to remove this client?");
                                        if(x == true){
                                            return true;
                                        }
                                        else{
                                            return false;
                                        }
                                    }
                                </script>
                                
                            </div>
                            <!-- Post -->
                            <div class="post">
                              <div class="user-block">
                                    <span class="username">
                                      <a target="_blank" href="{{ $client->url }}">{{ $client->name }}</a>
                                    </span>
                              </div>
                              <!-- /.user-block -->
                              <div class="row margin-bottom">
                                <div class="col-sm-12">
                                  <a target="_blank" href=""><img class="img-responsive" src="{{ asset($client->image) }}" alt="{{ asset($client->image) }}"></a>
                                </div>
                              </div>
                              <!-- /.row -->
                            </div>
                            <!-- /.post -->
                          </div>
                          <!-- /.tab-pane -->
                          <div class="tab-pane" id="cpanel">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Cpanel Username</th>
                                        <th>Cpanel Password</th>
                                        <th>Visit Cpanel</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $client->cpanel_username }}</td>
                                        <td>{{ $client->cpanel_password }}</td>
                                        <td>
                                            <a href='{{ $client->url . "/cpanel" }}' ><button class="btn btn-success fa fa-globe"> Visit</button></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          </div>
                          <!-- /.tab-pane -->
            
                          <div class="tab-pane" id="admin">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Admin Username</th>
                                        <th>Admin Password</th>
                                        <th>Visit Admin Page</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $client->admin_username }}</td>
                                        <td>{{ $client->admin_password }}</td>
                                        <td>
                                            <a href='{{ $client->url . "/login" }}' ><button class="btn btn-success fa fa-globe"> Visit</button></a>
                                        </td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          </div>
                          <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                      </div>
                      <!-- /.nav-tabs-custom -->
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
<!-- ./wrapper -->
@endsection