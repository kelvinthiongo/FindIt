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
        {{-- lost link 1 --}}
        <div class="container">
            <p><b>Didn't find your item? Click <a data-toggle="modal" data-target="#exampleModalCenter">Here</a> to submit document details.<b></p>
        </div>
        {{-- end lost link 1 --}}
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
                    @if ($count == 0)
                        <p><b>Sorry we did not find any data that matches what you searched for. For more accurate results, feed your details in the search input box SEPARATING  them with SPACES. For example, if you are searching for a documment with name: John Doe, and number: 12345678, you should search for "John Doe 12345678". <br> If you still did this and failed to get the results, click <a data-toggle="modal" data-target="#exampleModalCenter">here</a> to drop your details. We will get to you soon if someone uploads a document that matches your details, good luck.</b><br><br><br></p>
                    @endif
                    @foreach($items as $item)
                        @if($item->user->is_verified)
                            <div class="property property-row property-row-sidebar shadow-hover">
                                <a href="{{ route('items.show', ['slug' => $item->slug]) }}" class="property-img">
                                    <div class="img-fade"></div>
                                    <div class="property-tag button status">{{ $item->category }}</div>
                                    <div class="property-price button "> <i class="fa fa-check"></i> {{ $item->user->tag == '' ? $item->user->name : Auth::user()->tag }}</div>
                                    <div class="property-color-bar"></div>
                                    <img src="{{ asset(json_decode($item->image)[0]) }}" alt="item image" />
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
                                    <span class="right">
                                    <a href="{{ route('items.show', ['slug' => $item->slug]) }}" class="button button-icon"><i class="fa fa-angle-right"></i>Details</a>
                                    </span>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        @else
                            <div class="property property-row property-row-sidebar shadow-hover">
                                <a href="{{ route('items.show', ['slug' => $item->slug]) }}" class="property-img">
                                    <div class="img-fade"></div>
                                    <div class="property-tag button status">{{ $item->category }}</div>
                                    <div class="property-color-bar"></div>
                                    <img src="{{ asset(json_decode($item->image)[0]) }}" alt="Item image" />
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
                                        <form action="{{ route('report', ['slug' => $item->slug]) }}" method="post">
                                            @csrf
                                                <td><button type="submit" class="btn btn-default"><i class="fa fa-flag"></i> Report</button></td>
                                        </form>
                                        
                                        <td><i class="fa fa-user"></i> Uploaded by: <b>{{ $item->user->name }}<b></td>
                                    </tr>
                                    </table>
                                </div>
                                <div class="property-footer">
                                    <span class="left"><i class="fa fa-calendar-o icon"></i> {{ $item->created_at->diffForHumans() }}</span>
                                    <span class="right">
                                    <a href="{{ route('items.show', ['slug' => $item->slug]) }}" class="button button-icon"><i class="fa fa-angle-right"></i>Details</a>
                                    </span>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        @endif
                    @endforeach
                   <div class="pagination">
                        <div class="center">
                            <ul>
                                {{ $items->links() }}
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <br><br><br><br><br><br>
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
                                    <input type="submit" class="button" value="Search"/>
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
                                @endguest
                                <li><a href="/items/create">Upload Found Item</a></li>
                            </ul>
                        </div><!-- end widget content -->
                    </div><!-- end widget -->
                
                </div><!-- end sidebar -->
                </div>

                {{-- lost link 2 --}}
                <div class="col-12">
                    <div class="container">
                        <p>Didn't find your item? Click <a data-toggle="modal" data-target="#exampleModalCenter">Here</a> to submit document details.</p>
                    </div>
                </div>
                {{-- end lost link 2 --}}
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                    <form action="{{ route('lost.store')}}" class="multi-page-form" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="multi-page-form-content active">
                                                <h4><span>Submit Lost Document Details</span> </h4>
                                                <p><img src="{{ asset('client/images/divider-half.png') }}" alt="image" /></p><br>
                                                <div class="form-block">
                                                    <label>Document Type*</label>
                                                    <select name="category" class="border" required>
                                                            <option value=""></option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->name}}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                                <div class="form-block">
                                                    <label>Name (as they appear on the document)</label>
                                                    <input class="border" type="text" name="name" required/>
                                                </div>
                                                <div class="form-block">
                                                    <label>Document Number* (Id No, Reg N0, Passport No, etc)</label>
                                                    <input class="border" type="text" name="number" required/>
                                                </div>
                                                <div class="form-block">
                                                    <label>Email* (we will contact you via mail if we find your item)</label>
                                                    <input class="border" type="email" name="email" required/>
                                                </div>
                                    
                                        </div><!-- end basic info -->
                                    
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="button button-icon" data-dismiss="modal">Close</button>
                            <button type="submit" class="button button-icon"><i class="fa fa-send"></i>Submit Details</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                {{-- end modal --}}
                
            </div><!-- end row -->
        
        </div><!-- end container -->
    </section>
@endsection 