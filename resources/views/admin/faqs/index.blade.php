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
            FAQs
            <small>Available FAQs</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/admin/faqs/create"><i class="fa fa-plus"></i>Add FAQ</a></li>
            <li class="active">FAQs</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <!-- /.box -->
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Available FAQs</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if(count($faqs) > 0)
                        <table id="example1" class="table table-bordered table-striped">
                            <div style="display:none">{{$n = 0}}</div>
                            <thead>
                            <tr>
                            <th>No</th>
                            <th>FAQ</th>
                            <th>FAQ Answer</th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <ol>
                                    @foreach($faqs as $faq)
                                        <tr>
                                            <td>{{$n = $n + 1}}</td>
                                            <td>{{$faq->question}}</td>
                                            <td>{{$faq->answer}}</td>
                                            <td>
                                                <style>
                                                    .trans{
                                                        background-color:transparent;
                                                        border:0px;
                                                        color:red;
                                                    }
                                                    #action li {
                                                       display:inline;
                                                    }
                                                </style>
                                                <ul id="action" style="list-style-type:none;">
                                                    <li class="links">
                                                        <a href='/admin/faqs/{{$faq->id}}/edit' ><button style="color:green;" class="trans btn btn-success fa fa-pencil"> </button></a>
                                                    </li>
                                                    <li class="links">
                                                        {!! Form::open(['action' => ['FaqController@destroy',$faq->id], 'method' => 'POST','onsubmit' => 'return ConfirmDelete()']) !!}
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
                                <th>FAQ</th>
                                <th>FAQ Answer</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    @else
                        <p>There are no FAQs to display</p>
                    @endif
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