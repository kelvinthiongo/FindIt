@extends('client.layouts.app')
@section('content')
    <section class="subheader">
        <div class="container">
            <h1>Search results for: {{ $query['content'] }} </h1>
            <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="/" class="current">Search Results For: {{ $query['content'] }}</a></div>
            <div class="clear"></div>
        </div>
    </section>
  
    <section class="module">
        <div class="container">
        
            <div class="row">
                <div class="col-lg-8 col-md-8">
                
                    <div class="property-listing-header">
                        <span class="property-count left">{{ $count }} items found</span>
                        {{-- <form action="#" method="get" class="right">
                            <select name="sort_by" onchange="this.form.submit();">
                                <option value="date_desc">New to Old</option>
                                <option value="date_asc">Old to New</option>
                                <option value="price_desc">Price (High to Low)</option>
                                <option value="price_asc">Price (Low to High)</option>
                            </select>
                        </form>
                        <div class="property-layout-toggle right">
                            <a href="property-listing-grid-sidebar.html" class="property-layout-toggle-item"><i class="fa fa-th-large"></i></a>
                            <a href="property-listing-row-sidebar.html" class="property-layout-toggle-item active"><i class="fa fa-bars"></i></a>
                        </div> --}}
                        <div class="clear"></div>
                    </div><!-- end property listing header -->

                    @foreach($items as $item)
                        @if($item->user->is_verified)
                            <div class="property property-row property-row-sidebar shadow-hover">
                                <a href="#" class="property-img">
                                    <div class="img-fade"></div>
                                    <div class="property-tag button status">{{ $item->category->name }}</div>
                                    <div class="property-price button "> <i class="fa fa-check"></i> {{ $item->user->tag == '' ? $item->user->name : Auth::user()->tag }}</div>
                                    <div class="property-color-bar"></div>
                                    <img src="{{ asset($item->image) }}" alt="item image" />
                                </a>
                                <div class="property-content">
                                    <div class="property-title">
                                    <h4><a href="#">{{ $item->f_name . ' ' . $item->s_name . ' ' . $item->l_name}}</a></h4>
                                    <p class="property-address"><i class="fa fa-id-card icon"></i>{{ $item->number }}</p>
                                    <p class="property-text"><i class="fa fa-map-marker icon"></i><b>Where To Collect:<b> {{ $item->place_to_get }}.</p>
                                    
                                    </div>
                                    
                                    
                                
                                </div>
                                <div class="property-footer">
                                    <span class="left"><i class="fa fa-calendar icon"></i> {{ $item->created_at->diffForHumans() }} </span>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        @else
                            <div class="property property-row property-row-sidebar shadow-hover">
                                <a href="{{ route('show_item', ['slug' => $item->slug]) }}" class="property-img">
                                    <div class="img-fade"></div>
                                    <div class="property-tag button status">{{ $item->category->name }}</div>
                                    <div class="property-color-bar"></div>
                                    <img src="{{ asset($item->image) }}" alt="Item image" />
                                </a>
                                <div class="property-content">
                                    <div class="property-title">
                                    <h4><a href="#">{{ $item->f_name . ' ' . $item->s_name . ' ' . $item->l_name}}</a></h4>
                                    <p class="property-address"><i class="fa fa-id-card icon"></i>{{ $item->number }}</p>
                                    <div class="clear"></div>
                                    <p class="property-text"><i class="fa fa-map-marker icon"></i><b>Where Found:<b> {{ $item->place_found }}.</p>
                                    </div>
                                    <table class="property-details">
                                    <tr>
                                        <a href="{{ route('report', ['slug' => $item->slug]) }}"><td><i class="fa fa-flag"></i> Report</td></a>
                                        <td><i class="fa fa-user"></i> Uploaded by: <b>{{ $item->user->name }}<b></td>
                                    </table>
                                </div>
                                <div class="property-footer">
                                    <span class="left"><i class="fa fa-calendar-o icon"></i> {{ $item->created_at->diffForHumans() }}</span>
                                    <span class="right">
                                    <a href="{{ route('show_item', ['slug' => $item->slug]) }}" class="button button-icon"><i class="fa fa-angle-right"></i>Details</a>
                                    </span>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        @endif
                    @endforeach

                    {{ $items->links() }}
                </div>
                <div class="col-lg-4 col-md-4 sidebar">
                
                    <div class="widget widget-sidebar sidebar-properties advanced-search">
                    <h4><span>Search Here</span> <img src="{{ asset('client/images/divider-half-white.png') }}" alt="image" /></h4>
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
                        <li><a href="/login">Login</a></li>
                        <li><a href="/upload-item">Upload Found Item</a></li>
                        </ul>
                    </div><!-- end widget content -->
                    </div><!-- end widget -->
                
                </div><!-- end sidebar -->
                
            </div><!-- end row -->
        
        </div><!-- end container -->
    </section>
@endsection 