<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="24seven Developers is a web services company that deals in web design and development, graphics design, SEO services, Digital marketing">
    <meta name="keywords" content="24seven Developers, Best Web Designers and Web Developers in Kenya, Best Graphics designers,Web Design, Logo Design, Graphics Design, SEO Services in Kenya, Bronchure Design, Google SEO, Digital marketing">
    @yield('metatags')
    <!-- Search Engins -->
    <meta name="google-site-verification" content="Y5PvouaqUWp3oeoTnKAH0cwwSrilRNd6ci-NuZnW0PY" />
    <meta name="msvalidate.01" content="500FA769B85A70DC4EBC591790624604" />
    <!-- Document Title -->
    <title>24seven Developers - Best Web Designers & developers | SEO Specialists in Kenya</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="favicon.png">

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400,500,700%7CSource+Sans+Pro:300i,400,400i,600,700">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/swiper/swiper.min.css">
    <link rel="stylesheet" href="plugins/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" href="plugins/switcher/switcher.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/colors/theme-1.css">
    <link rel="stylesheet" href="css/custom.css">
    <!-- Start of Async Drift Code -->
<script>
"use strict";

!function() {
  var t = window.driftt = window.drift = window.driftt || [];
  if (!t.init) {
    if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
    t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], 
    t.factory = function(e) {
      return function() {
        var n = Array.prototype.slice.call(arguments);
        return n.unshift(e), t.push(n), t;
      };
    }, t.methods.forEach(function(e) {
      t[e] = t.factory(e);
    }), t.load = function(t) {
      var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
      o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
      var i = document.getElementsByTagName("script")[0];
      i.parentNode.insertBefore(o, i);
    };
  }
}();
drift.SNIPPET_VERSION = '0.3.1';
drift.load('ckwgs23vdpdr');
</script>
<!-- End of Async Drift Code -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120725705-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-120725705-1');
</script>

<!-- JSON-LD markup generated by Google Structured Data Markup Helper. -->
<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "LocalBusiness",
  "name" : "24Seven Developers",
  "image" : "https://www.24seven.co.ke/images/logo1.png",
  "telephone" : [ "+254 799315478", "+254 705889256" ],
  "email" : "info@24seven.co.ke",
  "address" : {
    "@type" : "PostalAddress",
    "addressLocality" : "Juja",
    "addressCountry" : "Kenya"
  },
  "url" : "https://www.24seven.co.ke/",
  "review" : {
    "@type" : "Review",
    "reviewRating" : {
      "@type" : "Rating",
      "ratingValue" : "4"
    }
  }
}
</script>

<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '317487975701905');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=317487975701905&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

    
</head>
@include('layouts.messages')

<body>
    <!-- Preloader -->
    <div class="preLoader"></div>

    <!-- Main header -->
    <header class="header">

        <div class="main-header" data-animate="fadeInUp" data-delay=".9">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-9">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="#">
                                <img src="img/logo.png" data-rjs="2" alt="VPNet">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-5 col-sm-2 col-3">
                        <nav>
                            <!-- Header-menu -->
                            <div class="header-menu">
                                <ul>
                                    <li class="active"><a href="/">Home</a></li>
                                    <li><a href="/about">About</a></li>
                                    <li><a href="/reviews">Reviews</a></li>
                                    <li><a href="/portfolio">Portfolio</a></li>
                                    <li>
                                        <a href="#">Services <i class="fa fa-caret-down"></i></a>
                                        <ul>
                                            <li><a href="/services">All services</a></li>
                                            <li><a href="/web-design">Web design</a></li>
                                            <li><a href="/graphics-design">Graphics design</a></li>
                                            <li><a href="/digital-marketing">Digital marketing</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">Blog</a>
                                    <li><a href="/contact">Contact</a></li>
                                </ul>
                            </div>
                            <!-- End of Header-menu -->
                        </nav>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 d-none d-sm-block">
                        <!-- Header Call -->
                        <div class="header-call text-right">
                            <span>Click to mail Us</span>
                            <a href="mailto:info@24seven.co.ke">info@24seven.co.ke</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End of Main header -->
        @yield('content')
    <!-- Footer -->
    <footer class="main-footer">
        <div class="footer-widgets light-bg border-top pt-80 pb-50">
            <div class="container">
                <div class="row">
                    <!-- Footer Widget -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget mb-30" data-animate="fadeInUp" data-delay=".1">
                            <h3 class="h4">Contact Us</h3>
                            <div class="contact-widget-content">
                                <p>In need of our services? Get in touch with us!</p>
                                <ul class="list-unstyled">
                                    <li>
                                        <i class="fa fa-phone"></i>
                                        <a>
                                            @foreach($phones as $phone)
                                                {{ $phone->phone }} 
                                                <br/>
                                            @endforeach
                                        </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope-o"></i>
                                        <a href="mailto:serviney.demo@fakemail.com">info@24seven.co.ke</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End of Footer Widget -->

                    <!-- Footer Widget -->
                    <div class="col-lg-2 col-sm-6">
                        <div class="footer-widget mb-30" data-animate="fadeInUp" data-delay=".3">
                            <h3 class="h4">Navigate</h3>
                            <div class="menu-wrap">
                                <ul class="menu">
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="reviews.html">Reviews</a></li>
                                    <li><a href="services">All services</a></li>
                                    <li><a href="https://blog.24seven.co.ke" target="_blank">Blog</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End of Footer Widget -->

                    <!-- Footer Widget -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget mb-30" data-animate="fadeInUp" data-delay=".3">
                            <h3 class="h4">Specialists in</h3>
                            <div class="menu-wrap">
                                <ul class="menu">
                                    <li><a href="web-design.html">Web Design & Development</a></li>
                                    <li><a href="digital-marketing.html">Digital Marketing</a></li>
                                    <li><a href="digital-marketing.html">SEO Specialists</a></li>
                                    <li><a href="#">Mobile App Development</a></li>
                                    <li><a href="#">Online Management Systems</a></li>
                                    <li><a href="graphics-design.html">Graphics Design</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End of Footer Widget -->

                    <!-- Footer Widget -->
                    <div class="col-lg-4 col-sm-6">
                        <div class="footer-widget mb-30" data-animate="fadeInUp" data-delay=".7">
                            <h3 class="h4">Read more on our blog</h3>
                            <div class="menu-wrap">
                                <ul class="menu">
                                    <li><a href="#">Businesses doing online are 27% more producitive</a></li>
                                    <li><a href="https://blog.24seven.co.ke/seo-explained/" target="_blank">What is SEO?</a></li>
                                    <li><a href="#">Why Blockchains is the future</a></li>
                                    <li><a href="#">The best hosting companies in Kenya compared</a></li>
                                    <li><a href="#">How to integrate the Mpesa API for faster payments</a></li>
                                    <li><a href="#">Best tech startups in Kenya</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End of Footer Widget -->
                </div>
            </div>
        </div>

        <div class="bottom-footer dark-bg">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Copyright -->
                    <div class="col-md-6">
                        <div class="copyright-text text-center text-md-left">
                            <p href="#" class="mb-md-0">&copy; 2018 Copyright 24seven Developers | All rights reserved.</p>
                        </div>
                    </div>

                    <!-- Social Profiles -->
                    <div class="col-md-6">
                        <ul class="social-profiles nav justify-content-center justify-content-md-end">
                            <li id="facebook"><a href="https://web.facebook.com/24sevenDevelopers" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li id="twitter"><a href="https://twitter.com/24sevenDevelop" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li id="google-plus"><a href="https://plus.google.com/109349826534246574265" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                            <li id="behance"><a href="https://www.behance.net/mathew62ce" target="_blank"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- Back to top -->
    <div class="back-to-top">
        <a href="#"> <i class="fa fa-chevron-up"></i></a>
    </div>

    <!-- JS Files -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="plugins/waypoints/jquery.waypoints.min.js"></script>
    <script src="plugins/waypoints/sticky.min.js"></script>
    <script src="plugins/swiper/swiper.min.js"></script>
    <script src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="plugins/parsley/parsley.min.js"></script>
    <script src="plugins/switcher/switcher.js"></script>
    <script src="plugins/retinajs/retina.min.js"></script>
    <script src="plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="js/menu.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
