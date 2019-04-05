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
            {{ $status }} Items
            <small>List of {{ $status }} Items</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Items Details</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col-xs-12">
            
            <!-- /.box -->

            <div class="box">
                <div class="box-header">
                <h3 class="box-title">View all {{ $status }} Items</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">


                <!-- To be deleted -->
                <div>
                    <form action="{{ route('search_item') }}" method="get" class="simple-search-form">
                    <input type="text" name="content" placeholder="Name/Number/place lost/date lost(eg 30thJune)" />
                    <input type="submit" value="GO" />
                    </form>
                </div>


                <ol>
                @foreach($items as $item)
                 
                        <li>{{ $item->f_name . ' ' . $item->s_name . ' ' . $item->l_name }} @if($item->resolved != null) (<a href="{{ route('show_by_id', ['slug' => $item->resolved]) }}" style="color: blue">found</a>) @endif | {{ $item->number }} | {{ $item->place_found }} | {{ $item->lf_date }}</li>
                   
                @endforeach
                </ol>

                {{-- {{ $items->links() }} --}}
                <br>
                <br>
                <br>
                <!-- To be deleted -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>id/reg_no etc</th>
                            <th>Category</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->f_name . ' ' . $item->s_name . ' ' . $item->l_name }} @if($item->resolved != null) (<a href="{{ route('show_by_id', ['slug' => $item->resolved]) }}" style="color: blue">found</a>) @endif</td>
                            <td>{{ $item->number }}</td>
                            <td>
                                @if($item->category()->count()==0)
                                    No Associated Agent
                                @else
                                    {{ $item->category->name }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('items.show', ['slug' => $item->slug]) }}" class="btn btn-xs btn-primary">View</a>
                            </td>
                        </tr>
                    @endforeach
                    
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>id/reg_no etc</th>
                        <th>Category</th>
                        <th>View</th>
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