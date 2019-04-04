@extends('client.layouts.app')
@section('content')
    <section class="subheader">
        <div class="container">
            <h1>Search results for: (Keyword Here) </h1>
            <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="/" class="current">Search Results For: (Keyword Here)</a></div>
            <div class="clear"></div>
        </div>
    </section>
  
    <section class="module">
        <div class="container">
        
            <div class="row">
                <div class="col-lg-8 col-md-8">
                
                    <div class="property-listing-header">
                        <span class="property-count left">8 items found</span>
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
                    <div class="property property-row property-row-sidebar shadow-hover">
                        <a href="#" class="property-img">
                            <div class="img-fade"></div>
                            <div class="property-tag button status">National Id</div>
                            <div class="property-color-bar"></div>
                            <img src="{{ asset('client/images/property-img1.jpg')}}" alt="" />
                        </a>
                        <div class="property-content">
                            <div class="property-title">
                            <h4><a href="#">John Doe Snow</a></h4>
                            <p class="property-address"><i class="fa fa-id-card icon"></i>Document Number</p>
                            <div class="clear"></div>
                            <p class="property-text"><i class="fa fa-map-marker icon"></i><b>Where Found:<b> It was found here.</p>
                            </div>
                            <table class="property-details">
                            <tr>
                                <td><i class="fa fa-flag"></i> Report</td>
                                <td><i class="fa fa-user"></i> Uploaded by: <b>Emily Beecham<b></td>
                            </table>
                        </div>
                        <div class="property-footer">
                            <span class="left"><i class="fa fa-calendar-o icon"></i> 5 days ago</span>
                            <span class="right">
                            <a href="#" class="button button-icon"><i class="fa fa-angle-right"></i>Details</a>
                            </span>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="property property-row property-row-sidebar shadow-hover">
                        <a href="#" class="property-img">
                            <div class="img-fade"></div>
                            <div class="property-tag button status">Student Id</div>
                            <div class="property-price button "> <i class="fa fa-check"></i> Jkuat</div>
                            <div class="property-color-bar"></div>
                            <img src="{{ asset('client/images/property-img1.jpg') }}" alt="" />
                        </a>
                        <div class="property-content">
                            <div class="property-title">
                            <h4><a href="#">John Doe Snow</a></h4>
                            <p class="property-address"><i class="fa fa-id-card icon"></i>Document Number</p>
                            <p class="property-text"><i class="fa fa-map-marker icon"></i><b>Where To Collect:<b> JKUAT Gate C.</p>
                            
                            </div>
                            
                            
                           
                        </div>
                        <div class="property-footer">
                            <span class="left"><i class="fa fa-calendar icon"></i> 5 days ago</span>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 sidebar">
                
                    <div class="widget widget-sidebar sidebar-properties advanced-search">
                    <h4><span>Search Here</span> <img src="{{ asset('client/images/divider-half-white.png') }}" alt="" /></h4>
                    <div class="widget-content box">
                        <form>
                        <div class="form-block border">
                            <label for="keywords">Enter Keywords</label>
                            <input type="text" name="keyword" placeholder="Enter search keywords" required/>
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