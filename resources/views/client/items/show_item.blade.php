 @extends('client.layouts.app')
@section('content')
    <section class="subheader">
        <div class="container">
        <h1>View {{ $item->category->name == 'others'? 'Item': $item->category->name }} {{ $item->f_name == ''? '' : 'for ' . $item->f_name }}</h1>
            <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="/" class="current">View {{ $item->category->name == 'others'? 'Item': $item->category->name }} {{ $item->f_name == ''? '' : 'for ' . $item->f_name }}</a></div>
            <div class="clear"></div>
        </div>
    </section>
    <section class="module">
        <div class="container">
        
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="property-single-item property-main">
                        <div class="property-header">
                            <div class="property-title">
                                <h4>{{ $item->f_name . ' ' . $item->l_name }}</h4>
                                <div class="property-price-single right"><span><i class="fa fa-calendar"></i> Uploaded at: {{ date("F d, Y", strtotime($item->created_at)) }}</span></div>
                                <p class="property-address"><i class="fa fa-id-card icon"></i>{{ $item->number }}</p>
                                <div class="clear"></div>
                            </div>
                            <div class="property-single-tags">
                                <div class="property-tag button alt featured">{{ $item->category->name }}</div>
                                @auth
                                    <a href="{{ route('approve', ['slug' => $item->slug]) }}" class="property-tag button alt info featured right" style="{{ Auth::user()->type == 'user'? 'display: none' : '' }}"><i class="fa fa-check icon"></i>Approve</a>
                                    <a href="{{ route('items.edit', ['slug' => $item->slug]) }}" class="property-tag button alt featured right" style="{{ $item->user->id != Auth::user()->id && Auth::user()->type == 'user'? 'display: none' : '' }}"><i class="fa fa-pencil icon"></i>Edit</a>  
                                @endauth
                                    
                            </div>
                        </div>
                        <table class="property-details-single">
                            <tr>
                                <td><i class="fa fa-phone"></i> <span>Call:</span> {{ $item->user->phone }}</td>
                                <td><i class="fa fa-envelope"></i> <span>Email:</span> {{ $item->user->email }}</td>
                               
                            </tr>
                        </table>
        
                        <div class="property-gallery">
                        <div class="slider-nav slider-nav-property-gallery">
                            <span class="slider-prev"><i class="fa fa-angle-left"></i></span>
                            <span class="slider-next"><i class="fa fa-angle-right"></i></span>
                        </div>
                        <div style="display: none;">
                            {{ $i = 0 }}
                        </div>
                        <div class="slide-counter"></div>
                            <div class="slider slider-property-gallery">
                                @foreach(json_decode($item->image) as $image)
                                    <div class="slide" style="position: relative">
                                        @auth
                                             <span style="{{ $item->user->id != Auth::user()->id && Auth::user()->type == 'user'? 'display: none' : '' }}">
                                                {!! Form::open(['action' => ['ItemsController@delete_image', $item->slug, $i], 'method' => 'DELETE']) !!}
                                                    <button onClick= "javascript: return confirm ('Are you sure you want to delete this image?');" class="btn btn-danger right" type="submit" style="transform: translate(100%, 0%);
                                                    -ms-transform: translate(100%, 0%); position: absolute"><i class="fa fa-trash icon"></i>Delete Image</button>
                                                {!! Form::close() !!}
                                            </span>
                                        @endauth
                                           
                                        
                                        <div style="display: none;">
                                            {{ $i++ }}
                                        </div>
                                        <a href="{{ asset($image) }}"><img src="{{ asset($image) }}" alt="" /></a>
                                    </div>
                                    
                                @endforeach
                            </div>
                            <div class="slider property-gallery-pager">
                                @foreach(json_decode($item->image) as $image)
                                    <a class="property-gallery-thumb"><img src="{{ asset($image) }}" alt="" /></a>
                                @endforeach
                            </div>
                            
                        </div>
        
                    </div><!-- end property title and gallery -->
        
                    <div class="widget property-single-item property-description content">
                        <h4>
                            <span>Description</span> <img class="divider-hex" src="{{ asset('client/images/divider-half.png') }}" alt="" />
                            <div class="divider-fade"></div>
                        </h4>
                        <p>{{ $item->description }}</p>

                        <p>This Item was Uploaded by <strong>{{ $item->user->name }}.</strong></p>
                        <div class="tabs">
                            <ul style="">
                                <li><a href="#tabs-1"><i class="fa fa-map-marker icon"></i>Where Found</a></li>
                                <li><a href="#tabs-2"><i class="fa fa-map-marker icon"></i>Where to collect</a></li>
                            </ul>
                            <div id="tabs-1" class="ui-tabs-hide">
                                <p>{{ $item->place_found == ''? 'Place not indicated.' : $item->place_found }}</p>
                            </div>
                            <div id="tabs-2" class="ui-tabs-hide">
                                <p>{{ $item->place_to_get }}</p>
                            </div>
                        </div>
                    </div><!-- end description -->

                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 sidebar">
                
                        <div class="widget widget-sidebar sidebar-properties advanced-search">
                        <h4><span>Search Here</span> <img src="{{ asset('client/images/divider-half-white.png') }}" alt="" /></h4>
                        <div class="widget-content box">
                            <form action="{{ route('search_item') }}" method="get">
                                <div class="form-block border">
                                    <label for="keywords">Enter Keywords</label>
                                    <input type="text" name="content" placeholder="Enter search keywords" required/>
                                </div>
                                <div class="form-block">
                                    <input type="submit" class="button" value="Search" />
                                </div>
                            </form>
                        </div><!-- end widget content -->
                        </div><!-- end widget -->
                        <div class="widget widget-sidebar recent-properties">
                        <h4><span>Quick Links</span> <img src="{{ asset('client/images/divider-half.png') }}" alt="" /></h4>
                        <div class="widget-content box">
                            <ul class="bullet-list">
                            <li><a href="/">Home</a></li>
                            <li><a href="/terms-and-policy">Terms & Policy</a></li>
                            <li><a href="/submit-query">Submit Query</a></li>
                            <li><a href="/faq">Frequently Asked Questions</a></li>
                            @auth
                                <li><a href="/uploaded-items">My Uploads</a></li>
                            @endauth
                            @guest
                                <li><a href="/login">Login</a></li>
                            @endauth
                            <li><a href="/upload-item">Upload Found Item</a></li>
                            </ul>
                        </div><!-- end widget content -->
                        </div><!-- end widget -->
                    
                    </div><!-- end sidebar -->
                </div><!-- end sidebar -->
            </div><!-- end row -->
        
        </div><!-- end container -->
    </section>
@endsection 