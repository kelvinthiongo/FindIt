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
           View Slider
            <small>Preview of the Slider</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('sliders.create') }}"> Add Slider Item</a></li>
            <li class="active">Slider</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <!-- START CAROUSEL-->
          <h2 class="page-header">Slider Items</h2>
          <div class="col-md-12">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Slider</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                @if($sliders->count() == 0)
                  <p>No Slider to Display</p>
                @else
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="hidden">{{ $n = 1 }}</div>
                      
                        @foreach($sliders as $slider)
                          <div class="item @if($n == 1) active @endif">
                            <img src="{{asset($slider->image)}}" alt="Slide">
        
                            <div class="col-md-12">
                            

                              
                            </div>
                            <div class="row">
                              <div class="col-md-12" style="text-align:center;">
                                <div class="box">
                                  <div class="box-header with-border">
                                  <h3> <strong>{{ $slider->message }}</strong> </h3>
                                  </div>
                                  <!-- /.box-header -->
                                  <div class="box-body col-md-12">
                                  <table  class="table">
                                        <thead>
                                            <tr>
                                                <td><a href="#"><button class=" btn btn-success fa fa-eye" data-toggle="tooltip" title="{{ $slider->link }}">{{ $slider->link_message }}</button></a> </td>
                                                <td>{!! Form::open(['action' => ['SlidersController@destroy', $slider->slug], 'method' => 'POST', 'id' => 'delete_form', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                    {{ Form::hidden('_method','DELETE')}}
                                            
                                                    {{ Form::button(' Delete',['class'=>'btn btn-danger fa fa-trash', 'type' => 'submit']) }}
                                        
                                                    {!! Form::close() !!}
                                                </td>
                                                
                                                <td>
                                                  <a href="{{ route('sliders.edit', ['slug' => $slider->slug]) }}" class="btn btn-primary ">
                                                    <i class="fa fa-pencil"></i> Edit
                                                  </a>
                                                </td> 
                                            </tr>   
                                        </thead>
                                        
                                    </table>
                                    
                                    
                                    <h4>{{ $slider->title }}</h4>
                                  </div>

                                  <div style="height:5px;">

                                  </div>
                                  <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                              </div>
                            </div>
                          </div>
                          <div class="hidden">{{ $n = $n + 1 }}</div>
                        @endforeach
                    
                      
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>
                  </div>
                @endif
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- END  CAROUSEL-->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('layouts.admin_footer')
    @include('layouts.aside_right')
  </div>
</body>
@endsection