@extends('client.layouts.app')
@section('content')
    <section class="subheader">
        <div class="container">
            <h1>Upload Found Document Here</h1>
            <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="/" class="current">Upload Found Items</a></div>
            <div class="clear"></div>
        </div>
    </section>
  
    <section class="module property-submit">
        <div class="container">
            <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
            <form action="{{ route('store_item') }}" class="multi-page-form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="multi-page-form-content active">
                        <h4><span>Upload Document Details</span> </h4>
                        <p>(Fields marked with (*) are Mandatory.</p>
                        <p><img src="{{ asset('client/images/divider-half.png') }}" alt="image" /></p><br>
                        <div class="form-block">
                            <label>Document Type*</label>
                            <select name="category_id" class="border" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-block">
                            <label>Document Number* (Id No, Reg N0, Passport No, etc)</label>
                            <input class="border" type="text" name="number" required/>
                        </div>
                        <div class="form-block text-center" style="display: {{ Auth::user()->is_verified ? '' : 'none' }}">
                            Submit at this point? Click the button!
                            <button type="submit" class="button button-icon"><i class="fa fa-upload"></i>Upload Item</button><br><br>
                        </div>
                        <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-block">
                            <label>Document First Name{{ Auth::user()->is_verified ? '' : '*' }}</label>
                            <input class="border" type="text" name="f_name" {{ Auth::user()->is_verified ? '' : 'required' }} />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-block">
                            <label>Document Second</label>
                            <input class="border" type="text" name="s_name" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-block">
                            <label>Document Last Name{{ Auth::user()->is_verified ? '' : '*' }}</label>
                            <input class="border" type="text" name="l_name" {{ Auth::user()->is_verified ? '' : 'required' }} />
                            </div>
                        </div>
                        </div>
                        <div class="form-block">
                            <label>Where Found{{ Auth::user()->is_verified ? '' : '*' }}</label>
                            <input class="border" type="text" name="location_found" {{ Auth::user()->is_verified ? '' : 'required' }} />
                        </div>
                        <div class="form-block">
                            <label>Where Owner can Find Item{{ Auth::user()->is_verified ? '' : '*' }}</label>
                            <input class="border" type="text" name="location_meet" {{ Auth::user()->is_verified ? '' : 'required' }} />
                        </div>
                        <div class="form-block">
                            <label>Document Image{{ Auth::user()->is_verified ? '' : '*' }}</label>
                            <input class="border" type="file" name="image" {{ Auth::user()->is_verified ? '' : 'required' }}/>
                        </div>
                        <div class="form-block">
                            <label>Description</label>
                            <textarea class="border" name="description"></textarea>
                        </div>
            
                        <div class="form-block">
                            <button type="submit" class="button button-icon"><i class="fa fa-upload"></i>Upload Item</button>
                        </div>
                        <div class="clear"></div>
            
                </div><!-- end basic info -->
            </form>
        
        </div><!-- end col -->
        </div><!-- end row -->
        
        </div><!-- end container -->
    </section>
@endsection 