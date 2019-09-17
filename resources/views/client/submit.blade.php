@extends('layouts.admin')
@section('content')

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

    </div>
    <header class="main-header">
        <!-- Logo -->
        <a href="/" target="_blank" class="logo">
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><h3>JKUAT LOST</h3></span>
            
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top hidden-xs">
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        @if(Auth::check())
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset(Auth::User()->avatar) }}" class="user-image" alt="User Image">
                            <span class="hidden-xs"> {{ Auth::User()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset(Auth::User()->avatar) }}" class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth::User()-> name }} - Admin
                                    <small>Member since
                                        {{ date('F d, Y', strtotime(Auth::User()->created_at)) }}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('users.show', ['slug' => Auth::user()->slug]) }}"
                                        class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    </a>

                                </div>
                            </li>
                        </ul>
                        @else
                        <a href="/admin">
                            <span> Admin</span>
                        </a>
                        @endif
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper no-margin">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Find Lost Document
                <small>Submit the details of the lost document here</small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <style>
                .box-special {
                    height: 350px;
                }

                .box-normal {
                    height: 350px;
                }

                @media (max-width:767px) {

                    .box-special {
                        height: 220px;
                    }
                }
            </style>
            <div class="row">
                <!-- left column -->
                <div class="col-md-5">
                    <div class="box box-special box-info box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-info"></i>

                            <h3 class="box-title">For Effective Document Recovery, Please note the following; </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul>
                                <li>check the <b>"number not visible"</b> box if your lost document's number is not visible or is not there at all.</li>
                                <li>Enter the details <b>EXACTLY</b> as they appear on the lost document. </li>
                                <li> Priority is given to the <b>Document Number.</b> Use the name only if the
                                    number is not visible on your lost Document.</li>
                                <li>All recovered documents will be collected at <b>VENUE HERE</b>.
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-7">
                    <!-- general form elements -->
                    <div id="holder" class="box box-normal box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title fa fa-search">Enter Document Details Below</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form id="check-doc" role="form" action="javascript:void(0)" method="POST">
                            @csrf
                            <div class="box-body">
                                <script>
                                    $(document).ready(function() {
                                                    $('#my_check').change(
                                                        function(){
                                                            if (this.checked) {
                                                                $("#number").attr("name", "name");
                                                                $("#number").attr("placeholder", "eg Jane Doe");
                                                                $("#no_label").text('Document Name');
                                                                $("#no-err").attr("id", "name-err");
                                                                $('#name-err').text('')
                                                                $("#number").val('');
                                                            }
                                                            else{
                                                                $("#number").attr("name", "number");
                                                                $("#number").attr("placeholder", "eg scm211-000/2013");
                                                                $("#no_label").text('Document Number');
                                                                $("#name-err").attr("id", "no-err");
                                                                $('#no-err').text('')
                                                                $("#number").val('');
                                                            }

                                                        }
                                                    );
                                                    $('#category').change(function(e) {
                                                        $('#err').text('');
                                                    });
                                                    $('#number').keypress(function(e) {
                                                        $('#err').text('');
                                                    });

                                                    $("#submit_btn").click(function(e) {
                                                        if(($('#category').val() == '') || ($('#number').val() == '')){
                                                        $('#err').text('All Fields are mandatory. Please confirm you have filled all fields');
                                                        }

                                                        else{
                                                            $('#holder').append("<div id='spinner' class='overlay'> <i class='fa fa-spin'><img src='{{asset('JKUAT.png')}}'><br></i></div>");

                                                            $.ajax({
                                                                url: '/check',
                                                                type: "POST",
                                                                data: $('#check-doc').serialize(),
                                                                success: function( response ) {
                                                                    if(response.match > 0){
                                                                        $('#exampleModalCenterTitle').text('Success Here');
                                                                        $('#res').html('<ul style = "list-style: none"><li>' + response.item + '</li><li>' + response.category + '</li></ul>');
                                                                        $('.callout').text('Record Exists!');
                                                                        $('.callout').attr('class','callout callout-success');
                                                                        $('#content').text('An item exists based on the details, you provided. Kindly visit ' + response.collection_point + ' to pick it.');

                                                                    }else{
                                                                        $('#exampleModalCenterTitle').text('No result Found')
                                                                        $('#res').text(response.item);
                                                                        $('.callout').text('Sorry No Such Record Exists!');
                                                                        $('.callout').attr('class','callout callout-danger');
                                                                        $('#content').text('');
                                                                    }
                                                                    $('#spinner').remove();
                                                                    jQuery.noConflict();
                                                                    $('#exampleModalCenter').modal('show');

                                                                },

                                                            });

                                                        }







                                                    });
                                                });
                                </script>
                                <style>
                                    .err {
                                        color: red;
                                    }
                                </style>

                                <div class="form-group">
                                    <label class="err" id="err"></label><br>
                                    <label for="category">Document Category</label>
                                    <select id="category" class="form-control" name="category">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label id="no_label" for="number">Document Number</label>
                                    <input id="number" name="number" type="text" class="form-control"
                                        placeholder="eg scm211-000/2013">
                                    <label class="err" id="no-err"></label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input id='my_check' type="checkbox"> <b>Number not visible</b>
                                    </label>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="sumit" id="submit_btn" class="btn btn-primary">Submit</button>
                            </div>
                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                        Launch demo modal
                                      </button> --}}
                        </form>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h4 >Search results for: <span id="res"></span></h4>
                                        <div style="font-size:28px; font-weight:bolder;" class='callout'></div>
                                        <div style="font-size:18px; font-weight:bolder;" id="content"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="no-margin-footer">
        <div class="pull-right hidden-xs">
            Developed by <a href="https://24seven.co.ke" target="_blank">24seven Developers</a>
        </div>
        <strong>Copyright &copy; {{date('Y')}} <a href="#"> JKUAT</a>.</strong> All rights
        reserved.
    </footer>

    </div>
</body>
<!-- ./wrapper -->
@endsection
