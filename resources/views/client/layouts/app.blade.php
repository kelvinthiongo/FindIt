<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="Homely - Responsive Real Estate Template">
  <meta name="author" content="Rype Creative [Chris Gipple]">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Find-it | Search | Add Lost Document</title>

  <!-- CSS file links -->
  <link href="{{ asset('client/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
  <link href="{{ asset('client/assets/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" media="screen">
  <link href="{{ asset('client/assets/jquery-ui-1.12.1/jquery-ui.min.css') }}" rel="stylesheet">
  <link href="{{ asset('client/assets/slick-1.6.0/slick.css') }}" rel="stylesheet">
  <link href="{{ asset('client/assets/chosen-1.6.2/chosen.min.css') }}" rel="stylesheet">
  <link href="{{ asset('client/css/nouislider.min.css') }}" rel="stylesheet">
  <link href="{{ asset('client/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('client/css/responsive.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
  <![endif]-->
</head>
<body>

<header class="header-default">

  <div class="top-bar">
    <div class="container">
        <div class="top-bar-left left">
          <ul class="top-bar-item right social-icons">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
          </ul>
          <div class="clear"></div>
        </div>
        <div class="top-bar-right right">
          <a href="login.html" class="top-bar-item"><i class="fa fa-sign-in icon"></i>Login</a>
          <a href="register.html" class="top-bar-item"><i class="fa fa-user-plus icon"></i>Register</a>
          <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
  </div>

  <div class="container">

    <!-- navbar header -->
    <div class="navbar-header">

      <div class="header-details">
        <div class="header-item header-search left">
          <table>
              <tr>
              <td><i class="fa fa-search"></i></td>
              <td class="header-item-text">
                <form class="search-form">
                  <input type="text" placeholder="Search..." />
                  <button type="submit"><i class="fa fa-search"></i></button>
                </form>
              </td>
            </tr>
          </table>
        </div>
        <div class="header-item header-phone left">
          <table>
            <tr>
              <td><i class="fa fa-phone"></i></td>
              <td class="header-item-text">
                Call us anytime<br/>
                <span>(+200) 123 456 5665</span>
              </td>
            </tr>
          </table>
        </div>
        <div class="header-item header-phone left">
          <table>
            <tr>
              <td><i class="fa fa-envelope"></i></td>
              <td class="header-item-text">
                Drop us a line<br/>
                <span>hello@homely.com</span>
              </td>
            </tr>
          </table>
        </div>
        <div class="clear"></div>
      </div>

      <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="Homely" /></a>

      <!-- nav toggle -->
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    </div>

    <!-- main menu -->
    <div class="navbar-collapse collapse">
      <div class="main-menu-wrap">
        <div class="container-fixed">

        <div class="member-actions right">
          <a href="user-submit-property.html" class="button small alt button-icon"><i class="fa fa-plus"></i>Submit Property</a>
        </div>
        <ul class="nav navbar-nav right">
          <li class="menu-item-has-children current-menu-item">
            <a href="index.html">Home</a>
            <ul class="sub-menu">
              <li><a href="index.html">Simple Search</a></li>
              <li><a href="index-slider-1.html">Slider Style 1</a></li>
              <li><a href="index-slider-2.html">Slider Style 2</a></li>
			  <li><a href="index-slider-3.html">Slider Style 3</a></li>
              <li><a href="index-map.html">Google Maps Style 1</a></li>
              <li><a href="index-map-horizontal.html">Google Maps Style 2</a></li>
              <li class="menu-item-has-children">
                <a href="index.html">Headers</a>
                <ul class="sub-menu">
                  <li><a href="index.html">Header Default</a></li>
                  <li><a href="index-header-classic.html">Header Classic</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="menu-item-has-children">
            <a href="property-listing-grid.html">Properties</a>
            <ul class="sub-menu">
              <li><a href="property-listing-grid.html">Listing Grid</a></li>
              <li><a href="property-listing-grid-sidebar.html">Listing Grid Sidebar</a></li>
              <li><a href="property-listing-row.html">Listing Row</a></li>
              <li><a href="property-listing-row-sidebar.html">Listing Row Sidebar</a></li>
              <li><a href="property-listing-map.html">Listing Map</a></li>
              <li class="menu-item-has-children">
                <a href="property-single.html">Property Single</a>
                <ul class="sub-menu">
                  <li><a href="property-single.html">Property Single Classic</a></li>
                  <li><a href="property-single-full.html">Property Single Full Width</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="menu-item-has-children">
            <a href="agent-listing-grid.html">Agents</a>
            <ul class="sub-menu">
              <li><a href="agent-listing-grid.html">Agent Listing Grid</a></li>
              <li><a href="agent-listing-grid-sidebar.html">Agent Listing Grid Sidebar</a></li>
              <li><a href="agent-listing-row.html">Agent Listing Row</a></li>
              <li><a href="agent-listing-row-sidebar.html">Agent Listing Row Sidebar</a></li>
              <li><a href="agent-single.html">Agent Single</a></li>
            </ul>
          </li>
          <li class="menu-item-has-children">
            <a href="blog-right-sidebar.html">Blog</a>
            <ul class="sub-menu">
              <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
              <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
              <li><a href="blog-full-width.html">Blog Full Width</a></li>
              <li><a href="blog-creative.html">Blog Creative</a></li>
              <li><a href="blog-single.html">Blog Single</a></li>
            </ul>
          </li>
          <li class="menu-item-has-children">
            <a href="#">Pages</a>
            <ul class="sub-menu">
              <li><a href="about.html">About</a></li>
              <li><a href="faq.html">FAQ</a></li>
              <li><a href="404.html">404 Error</a></li>
              <li><a href="login.html">Login</a></li>
              <li><a href="register.html">Register</a></li>
			  <li class="menu-item-has-children">
                <a href="user-my-properties.html">User Pages</a>
                <ul class="sub-menu">
				  <li><a href="user-profile.html">User Profile</a></li>
                  <li><a href="user-my-properties.html">My Properties</a></li>
				  <li><a href="user-favorite-properties.html">Favorited Properties</a></li>
                  <li><a href="user-submit-property.html">Submit Property</a></li>
                </ul>
              </li>
              <li><a href="elements.html">Elements</a></li>
            </ul>
          </li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <div class="clear"></div>

      </div>

      </div><!-- end main menu wrap -->
    </div><!-- end navbar collaspe -->

  </div><!-- end container -->
</header>

@yield('content')

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4 widget footer-widget">
                <a class="footer-logo" href="index.html"><img src="images/logo-white.png" alt="Homely" /></a>
                <p>Lorem ipsum dolor amet, consectetur adipiscing elit. Sed ut 
                purus eget nunc ut dignissim cursus at a nisl. Mauris vitae 
                turpis quis eros egestas tempor sit amet a arcu. Duis egestas 
                hendrerit diam.</p>
                <div class="divider"></div>
                <ul class="social-icons circle">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 widget footer-widget from-the-blog">
                <h4><span>From the Blog</span> <img src="images/divider-half.png" alt="" /></h4>
                <ul>
                    <li>
                      <a href="#"><h3>Open House at 123 Smith Drive</h3></a>
                      <p>Vel fermentum ipsum. Quis molestie odio. Interdum et...<br/> <a href="#">Read More</a></p>
                      <div class="clear"></div>
                    </li>
                     <li>
                        <a href="#"><h3>Open House at 123 Smith Drive</h3></a>
                        <p>Vel fermentum ipsum. Quis molestie odio. Interdum et...<br/> <a href="#">Read More</a></p>
                        <div class="clear"></div>
                      </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 widget footer-widget">
                <h4><span>Get In Touch</span> <img src="images/divider-half.png" alt="" /></h4>
                <p>123 Smith Drive<br/>
                Annapolis, MD 21012<br/>
                United States
                </p>
                <p>
                <b class="open-hours">Open Hours</b><br/>
                Mondy - Friday: 9 am - 5 pm<br/>
                Saturday: 9 am - 1pm<br/>
                Sunday: Closed
                </p>
                <p class="footer-phone"><i class="fa fa-phone icon"></i> (123) 456-7890</p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 widget footer-widget newsletter">
                <h4><span>Newsletter</span> <img src="images/divider-half.png" alt="" /></h4>
                <p><b>Subscribe to our newsletter!</b> Vel lorem ipsum. Lorem molestie odio. Interdum et malesuada fames ac ante ipsum primis in faucibus. </p>
                <form class="subscribe-form" method="post" action="#">
                    <input type="text" name="email" value="Your email" />
                    <input type="submit" name="submit" value="SEND" class="button small alt" />
                </form>
            </div>
        </div><!-- end row -->
    </div><!-- end footer container -->
</footer>

<div class="bottom-bar">
    <div class="container">
    © {{date('Y')}}  |  find-it | designed and developed by <a target="_blank" href="https://www.24seven.co.ke" target="_blank">24seven Developers</a>  |  All Rights Reserved
    </div>
</div>

<!-- JavaScript file links -->
<script src="{{ asset('client/js/jquery-3.1.1.min.js') }}"></script>      <!-- Jquery -->
<script src="{{ asset('client/assets/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
<script src="{{ asset('client/js/bootstrap.min.js') }}"></script>  <!-- bootstrap 3.0 -->
<script src="{{ asset('client/assets/slick-1.6.0/slick.min.js') }}"></script> <!-- slick slider -->
<script src="{{ asset('client/assets/chosen-1.6.2/chosen.jquery.min.js') }}"></script> <!-- chosen - for select dropdowns -->
<script src="{{ asset('client/js/isotope.min.js') }}"></script> <!-- isotope-->
<script src="{{ asset('client/js/wNumb.js') }}"></script> <!-- price formatting -->
<script src="{{ asset('client/js/nouislider.min.js') }}"></script> <!-- price slider -->
<script src="{{ asset('client/js/global.js') }}"></script>
</body>
</html>