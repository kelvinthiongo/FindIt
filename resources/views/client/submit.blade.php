@extends('layouts.admin')
@section('content')

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="/" target="_blank" class="logo">
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img src="{{ asset('logo-white.png')}}" alt="JKUAT Logo" /></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
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
                                        {{ Auth::User()-> name }} - Admin at FindIt
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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="" class="user-image" alt="User Image">
                                <span class="hidden-xs"> Admin Login</span>
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
                                    <li>The Name Field is not <b>Mandatory</b> if your lost document has its number</li>
                                    <li>Enter the details <b>EXACTLY</b> as they appear on the lost document </li>
                                    <li> Priority is given to the <b>Document Number.</b> Use the name only if the
                                        number is not visible on your lost Document</li>
                                    <li>Incase no detail (name and number) is <b>VISIBLE</b> on your document, <a
                                            href=""> <b>Click Here</b></a> to view a list of all unmatched documents
                                    </li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <div class="col-md-7">
                        <!-- general form elements -->
                        <div class="box box-normal box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title fa fa-search">Enter Document Details Below</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" action="javascript:void(0)" method="POST">
                                @csrf
                                <div class="box-body">
                                    <script>
                                        $(document).ready(function() {
                                            $('#my_check').change(
                                                function(){
                                                    if (this.checked) {
                                                        $("#number_field").attr("name", "name");
                                                        $("#number_field").attr("placeholder", "eg Jane Doe");
                                                        $("#no_label").text('Document Name');
                                                    }
                                                    else{
                                                        $("#number_field").attr("name", "number");
                                                        $("#number_field").attr("placeholder", "eg scm211-000/2013");
                                                        $("#no_label").text('Document Number');
                                                    }

                                                }
                                            );
                                            $("#submit_btn").click(function() {

                                            });
                                        });
                                    </script>
                                    <div class="form-group">
                                        <label for="category">Document Category</label>
                                        <select id="category" class="form-control" name="category">
                                            <option>-- Select Category --</option>
                                            <option value="test">test</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label id="no_label" for="number_field">Document Number</label>
                                        <input id="number_field" name="number" type="text" class="form-control"
                                            placeholder="eg scm211-000/2013">
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
                            </form>
                            {{-- <div class="overlay">
                                <i class="fa fa-spin"><img src="{{asset('JKUAT.png')}}"><br></i>
                        </div> --}}
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
