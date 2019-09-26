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
                    {{ $user->name }}'s Profile
                    <div style="display:inline">
                        @if($user->deleted_at != null) <small style="color:red">trashed!
                            {!! Form::open(['action' => ['UsersController@restore', $user->slug], 'method' => 'POST'])
                            !!}
                            @csrf
                            <button
                                class="btn btn-success @if(Auth::user()->type == 'super' || Auth::user()->id == $user->id || $user->type == 'user') @else disabled @endif"><i
                                    class="fa fa-undo"></i> Restore</button>
                            {!! Form::close() !!}
                            @endif </small>
                    </div>

                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="{{ route('admin_index') }}"><i class="fa fa-users"></i> Admins</a></li>
                    <li class="active">User profile</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <!-- Profile Image -->
                        <div class="box box-primary" style="height:410px;">
                            <div class="box-body box-profile">
                                <a href="javascript:void(0)">
                                    <img class="profile-user-img img-responsive img-circle"
                                        src="{{ asset($user->avatar) }}" alt="User profile picture">
                                </a>

                                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Member Since</b> <a
                                            class="pull-right">{{ date('F d, Y', strtotime($user->created_at)) }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b> <a class="pull-right">{{ $user->email }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phone</b> <a class="pull-right">{{ $user->phone }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>User Status</b> <a class="pull-right"> @if($user->type == 'super') Super Admin
                                            @elseif($user->type == 'ordinary') Ordinary Admin @else User @endif</a>
                                    </li>
                                </ul>
                                @if ($user->type == 'user' || Auth::user()->type == 'super' || Auth::user()->id ==
                                $user->id)
                                {!! Form::open(['action' => ['UsersController@destroy', $user->slug], 'method' =>
                                'DELETE']) !!}
                                <a href="{{ route('users.edit', ['slug' => $user->slug]) }}" class="btn btn-primary" style="float:right"><i
                                    class="fa fa-edit"></i>Edit</a>
                                @if(Auth::user() == $user)
                                <button onClick="javascript: return confirm ('Are you sure you want to exit?');"
                                    class="btn btn-danger" type="submit">Delete Account</button>
                                @else
                                <button
                                    onClick="javascript: return confirm ('Are you sure you want to remove {{ $user->name }}?');"
                                    class="btn btn-danger" type="submit">Remove</button>
                                @endif
                                {!! Form::close() !!}
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
<!-- ./wrapper -->
@endsection
