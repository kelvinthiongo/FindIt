@extends('client.layouts.app')
@section('content')
    <section class="subheader">
        <div class="container">
            <h1>View (category) for (First name) </h1>
            <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="/" class="current">View (category) for (First name)</a></div>
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
                                <h4>John Doe Smith</h4>
                                <div class="property-price-single right"><span><i class="fa fa-calendar"></i> Uploaded at: 30th January 2019</span></div>
                                <p class="property-address"><i class="fa fa-id-card icon"></i>Id Number</p>
                                <div class="clear"></div>
                            </div>
                            <div class="property-single-tags">
                                <div class="property-tag button alt featured">National Id</div>
                            </div>
                        </div>
                        <table class="property-details-single">
                            <tr>
                                <td><i class="fa fa-phone"></i> <span>Call:</span> 0799 888 888</td>
                                <td><i class="fa fa-envelope"></i> <span>Email:</span> user@email.com</td>
                               
                            </tr>
                        </table>
        
                        <div class="property-gallery">
                        <div class="slider-nav slider-nav-property-gallery">
                            <span class="slider-prev"><i class="fa fa-angle-left"></i></span>
                            <span class="slider-next"><i class="fa fa-angle-right"></i></span>
                        </div>
                        <div class="slide-counter"></div>
                        <div class="slider slider-property-gallery">
                            <div class="slide"><img src="{{ asset('client/images/property-img5.jpg') }}" alt="" /></div>
                            <div class="slide"><img src="{{ asset('client/images/property-img6.jpg') }}" alt="" /></div>
                            <div class="slide"><img src="{{ asset('client/images/property-img3.jpg') }}" alt="" /></div>
                            <div class="slide"><img src="{{ asset('client/images/property-img4.jpg') }}" alt="" /></div>
                            <div class="slide"><img src="{{ asset('client/images/property-img1.jpg') }}" alt="" /></div>
                            <div class="slide"><img src="{{ asset('client/images/property-img2.jpg') }}" alt="" /></div>
                            <div class="slide"><img src="{{ asset('client/images/property-img3.jpg') }}" alt="" /></div>
                        </div>
                        <div class="slider property-gallery-pager">
                            <a class="property-gallery-thumb"><img src="{{ asset('client/images/property-img5.jpg') }}" alt="" /></a>
                            <a class="property-gallery-thumb"><img src="{{ asset('client/images/property-img6.jpg') }}" alt="" /></a>
                            <a class="property-gallery-thumb"><img src="{{ asset('client/images/property-img3.jpg') }}" alt="" /></a>
                            <a class="property-gallery-thumb"><img src="{{ asset('client/images/property-img4.jpg') }}" alt="" /></a>
                            <a class="property-gallery-thumb"><img src="{{ asset('client/images/property-img1.jpg') }}" alt="" /></a>
                            <a class="property-gallery-thumb"><img src="{{ asset('client/images/property-img2.jpg') }}" alt="" /></a>
                            <a class="property-gallery-thumb"><img src="{{ asset('client/images/property-img3.jpg') }}" alt="" /></a>
                        </div>
                        </div>
        
                    </div><!-- end property title and gallery -->
        
                    <div class="widget property-single-item property-description content">
                        <h4>
                            <span>Description</span> <img class="divider-hex" src="{{ asset('client/images/divider-half.png') }}" alt="" />
                            <div class="divider-fade"></div>
                        </h4>
                        <p>Ut euismod ultricies sollicitudin. Curabitur sed dapibus nulla. Nulla eget iaculis lectus. Mauris ac maximus neque. Nam 
                        in mauris quis libero sodales eleifend. Morbi varius, nulla sit amet rutrum elementum, est elit finibus tellus, ut 
                        tristique elit risus at metus. Sed fermentum, lorem vitae efficitur imperdiet, neque velit tristique turpis, et iaculis 
                        mi tortor finibus turpis.
                        </p>
        
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. 
                        Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. 
                        Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, 
                        a consequat purus viverra a. Aliquam pellentesque nibh et nibh feugiat gravida. Maecenas ultricies, diam vitae semper 
                        placerat, velit risus accumsan nisl, eget tempor lacus est vel nunc. Proin accumsan elit sed neque euismod fringilla. 
                        Curabitur lobortis nunc velit, et fermentum urna dapibus non. Vivamus magna lorem, elementum id gravida ac, laoreet 
                        tristique augue. Maecenas dictum lacus eu nunc porttitor, ut hendrerit arcu efficitur.</p>

                        <p>This Item was Uploaded by <strong>John Doe</strong></p>
        
                        <div class="tabs">
                            <ul style="">
                            <li><a href="#tabs-1"><i class="fa fa-map-marker icon"></i>Where Found</a></li>
                            <li><a href="#tabs-2"><i class="fa fa-map-marker icon"></i>Where to collect</a></li>
                           
                            </ul>
                            <div id="tabs-1" class="ui-tabs-hide">
                                <p>This Document was found here</p>
                            </div>
                            <div id="tabs-2" class="ui-tabs-hide">
                                <p>This Document can be collected here</p>
                            </div>
                            <div id="tabs-3" class="ui-tabs-hide">
                                <ul style="list-style-type:none;">
                                    <a href="tel:0712999999" target="_blank"><li><i class="fa fa-phone"></i> 0712 999 999</li></a>
                                    <a href="mailto:email@email.com" target="_blank"><li><i class="fa fa-envelope"></i>  user@email.com</li></a>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end description -->

                </div><!-- end col -->
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
                </div><!-- end sidebar -->
            </div><!-- end row -->
        
        </div><!-- end container -->
    </section>
@endsection 