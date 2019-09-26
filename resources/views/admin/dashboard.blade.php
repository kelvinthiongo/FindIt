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
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    @if (Auth::user()->type == 'super')
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ $admins }}</h3>

                                <p>Admins</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="/admin/admins" class="small-box-footer">More info <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    <div class="{{ Auth::user()->type == 'super'? 'col-lg-6 col-xs-6': 'col-lg-12 col-xs-12' }}">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ number_format($items) }}</h3>
                                <p>Documents</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-id-card"></i>
                            </div>
                            <a href="/admin/items" class="small-box-footer">More info <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ number_format($uncollected_items) }}</h3>
                                <p>Uncollected Documents</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-id-card"></i>
                            </div>
                            <a href="{{ route('items.uncollected') }}" class="small-box-footer">More info <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ number_format($collected_items) }}</h3>
                                <p>Collected Documents</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-id-card"></i>
                            </div>
                            <a href="{{ route('items.collected') }}" class="small-box-footer">More info <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xs-12">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ $categories }}</h3>

                                <p>Categories</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list"></i>
                            </div>
                            <a href="/admin/categories" class="small-box-footer">More info <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
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
