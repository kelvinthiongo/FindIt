@extends('client.layouts.app')
@section('content')
    <section class="subheader">
        <div class="container">
            <h1>Edit Document Here</h1>
            <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="/" class="current">Edit Items</a></div>
            <div class="clear"></div>
        </div>
    </section>
  
    <section class="module property-submit">
        <div class="container">
            <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
            {!! Form::open(['action' => ['ItemsController@update', 'slug' => $item->slug], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class' => 'multi-page-form']) !!}
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
                            <input class="border" type="text" name="number" required value="{{ $item->number }}"/>
                        </div>
                        <div class="form-block text-center" style="display: {{ Auth::user()->is_verified ? '' : 'none' }}">
                            Submit at this point? Click the button!
                            <button type="submit" class="button button-icon"><i class="fa fa-upload"></i>Save Changes</button><br><br>
                        </div>
                        <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-block">
                            <label>Document First Name{{ Auth::user()->is_verified ? '' : '*' }}</label>
                            <input class="border" type="text" name="f_name" {{ Auth::user()->is_verified ? '' : 'required' }} value="{{ $item->f_name }}" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-block">
                            <label>Document Second Name</label>
                            <input class="border" type="text" name="s_name" value="{{ $item->s_name }}"/>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-block">
                            <label>Document Last Name{{ Auth::user()->is_verified ? '' : '*' }}</label>
                            <input class="border" type="text" name="l_name" {{ Auth::user()->is_verified ? '' : 'required' }} value="{{ $item->l_name }}" />
                            </div>
                        </div>
                        </div>
                        <div class="form-block">
                            <label>Where Found{{ Auth::user()->is_verified ? '' : '*' }}</label>
                            <input class="border" type="text" name="place_found" {{ Auth::user()->is_verified ? '' : 'required' }} value="{{ $item->place_found }}" />
                        </div>
                        <div class="form-block">
                            <label>Where Owner can Find Item{{ Auth::user()->is_verified ? '' : '*' }}</label>
                            <input class="border" type="text" name="place_to_get" {{ Auth::user()->is_verified ? '' : 'required' }} value="{{ $item->place_to_get }}" />
                        </div>
                        <div class="form-block increment">
                            <label>Document Image{{ Auth::user()->is_verified ? '' : '*' }}</label>
                            @if ($count < 4)
                                <input class="border" type="file" name="image[]"/>
                                <div class="input-group-btn"> 
                                    <button class="btn btn-success" type="button"><i class="fa fa-plus"></i>Add Another Image</button>
                                </div>
                            @else
                                <p>You have already uploaded 4 images for this item, please visit <a href="{{ route('items.show', ['slug' => $item->slug]) }}">the item</a> and delete unneccessary images.</p>
                            @endif
                                
                        </div>
                        <div class="form-block clone hide">
                            <div class="control-group input-group" style="margin-top:10px">
                                <input name='image[]' type="file" class="border">
                                <div class="input-group-btn">
                                    <button class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-block">
                            <label>Description</label>
                            <textarea class="border" name="description">{{ $item->description }}</textarea>
                        </div>
            
                        <div class="form-block">
                            <button type="submit" class="button button-icon"><i class="fa fa-upload"></i>Save</button>
                        </div>
                        <div class="clear"></div>
            
                </div><!-- end basic info -->
            </form>
        
        </div><!-- end col -->
        </div><!-- end row -->
        
        </div><!-- end container -->
    </section>
    <script type="text/javascript">

        $(document).ready(function() {
        var n = {{ $count }};
        $(".btn-success").click(function(){ 
            if(n > 2)
                return false;
            var html = $(".clone").html();
            $(".increment").after(html);
            n++;
        });

        $("body").on("click",".btn-danger",function(){
            if(n>0)
                n--; 
            $(this).parents(".control-group").remove();
        });

        });

    </script>
@endsection 