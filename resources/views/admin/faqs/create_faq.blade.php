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
               Add a faq
                <small>Add a New faq Here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/faqs">faqs</a></li>
                <li class="active">New faq</li>
            </ol>
            </section>
            <!-- Main content -->
            <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title fa fa-plus">Add faq</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="POST" action="javascript:void(0)" enctype="multipart/form-data" id="faq">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                {{ Form::label('Queston') }}

                                {{Form::text('question' ,'', ['class' => 'form-control','id' => 'exampleInputEmail1', 'placeholder' => 'Enter the faq']) }}
                               
                            </div>
                            <div class="form-group">
                                    {{ Form::label('Answer') }}
    
                                    {{Form::textarea('answer' ,'', ['class' => 'form-control','id' => 'exampleInputEmail1', 'placeholder' => 'Enter the answer to the faq above']) }}
                            </div>
                            <style>
                                .d-none{
                                    display: none;
                                }
                                .error{
                                    color:red;
                                }
                            </style>
                            
                            <div class="alert alert-success d-none" id="msg_div">
                                <span id="res_message"></span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button class="fa fa-plus btn btn-primary" id="send_form" type="submit"> Add Faq</button>
                            
                        </div>
                    {!! Form::close() !!}
                    <script>
                        if ($("#faq").length > 0) {
                         $("#faq").validate({
                         rules: {
                           question: {
                             required: true,
                           },
                       
                            answer: {
                                 required: true,
                            },
                         },
                         messages: {
                           question: {
                             required: "Please enter a faq",
                           },
                           answer: {
                             required: "Please provide an answer to the faq",
                           },
                         },
                         submitHandler: function(form) {
                          $.ajaxSetup({
                               headers: {
                                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                               }
                           });
                           $('#send_form').html('Adding Faq..');
                           $.ajax({
                             url: '/admin/faqs' ,
                             type: "POST",
                             data: $('#faq').serialize(),
                             success: function( response ) {
                                $('#send_form').html('Add Faq');
                                toastr.success(response.message, response.title);
                                document.getElementById("faq").reset(); 
                             }
                           });
                         }
                       })
                     }
                    </script>
                </div>
             
                
                <!-- /.box -->
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