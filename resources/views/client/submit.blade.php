@extends('layouts.admin')
@section('content')

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('layouts.header')
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
                            <form role="form" action="/" method="POST">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="category">Document Category</label>
                                        <select id="category" class="form-control">
                                            <option>-- Select Category --</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="number">Document Number</label>
                                        <input type="text" class="form-control" id="number"
                                            placeholder="eg scm211-000/2013">
                                    </div>

                                    <div class="form-group">
                                        <label for="number">Document Name</label>
                                        <input type="text" class="form-control" id="number" placeholder="eg John Doe">
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <div class="overlay">
                                <i class="fa fa-spin"><img src="{{asset('JKUAT.png')}}"><br></i>
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
                <b>24 seven</b> Developers
            </div>
            <strong>Copyright &copy; 2018 <a href="#"> 24 Seven Developers</a>.</strong> All rights
            reserved.
        </footer>

    </div>
</body>
<!-- ./wrapper -->
@endsection
