<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="FindIt - Upload and Search for Lost Documents">
  <meta name="keywords" content="FindIt, Upload and Search for Lost Documents, lost documents, found documents">
  <meta name="author" content="24seven Developers">
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
  <!--Toaster Popup message CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  {{-- favicon --}}
  <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />

  {{-- Image Display To Social media and such--}}
  <meta property="og:image" content="{{ asset('findIt-logo.png') }}" />
  <meta property="og:title" content="Find-it | Search | Add Lost Documents" />
  <meta property="og:url" content="https://findit.24seven.co.ke" />
  <meta property="og:description" content="FindIt - Upload and Search for Lost Documents" />
  <meta property="og:image" content="{{ asset('FindIt-logo.png') }}" />
  <meta property="og:type" content="" /> <!-- http://ogp.me/#types -->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
  <![endif]-->
  <!--crisp-->
  <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="445ed02f-28bf-4306-b094-b1ccc694aec7";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
</head>
<body>

<header class="header-default">

  <div class="top-bar">
    <div class="container">
        <div class="top-bar-left left">
          <ul class="top-bar-item right social-icons">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
          </ul>
          <div class="clear"></div>
        </div>
        <div class="top-bar-right right">
          @guest
            <a href="/login" class="top-bar-item"><i class="fa fa-sign-in icon"></i>Login</a>
            <a href="/register" class="top-bar-item"><i class="fa fa-user-plus icon"></i>Register</a>
          @endauth
          @auth
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fa fa-reply icon"></i>
                {{ __('Logout') }}
            </a>
            <a href="/profile" class="top-bar-item isActiveRoute('profile')"><i class="fa fa-user-plus icon"></i>Profile ({{ (explode(' ', Auth::user()->name))[0] }})</a>
          @endauth
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
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
                  <form action="{{ route('search_item') }}" method="get" class="search-form">
                    <input type="text" name="content" placeholder="Document details" />
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
                <a href="tel:{{ $admin_on_duty->phone }}">Call Support</a><br/>
                <span>{{ $admin_on_duty->phone }}</span>
              </td>
            </tr>
          </table>
        </div>
        <div class="header-item header-phone left">
          <table>
            <tr>
              <td><i class="fa fa-envelope"></i></td>
              <td class="header-item-text">
                <a href="mailto:findit@24seven.co.ke">Email Support</a><br/>
                <span>findit@24seven.co.ke</span>
              </td>
            </tr>
          </table>
        </div>
        <div class="clear"></div>
      </div>

      <a class="navbar-brand" href="/"><img src="{{ asset('logo.png') }}" alt="Findit" /></a>

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
          <a href="{{ route('items.create') }}" class="button small alt button-icon"><i class="fa fa-upload"></i>Upload Found Document</a>
        </div>
        <ul class="nav navbar-nav right">
          <li class="{{ isActiveRoute('landing') }}"><a href="/">Home</a></li>
          <li class="{{ isActiveRoute('faq') }}"><a href="/faq">FAQ</a></li>
          <li class="{{ isActiveRoute('terms') }}"><a href="/terms-and-policy">Terms & policy</a></li>
          <li class="{{ isActiveRoute('contact') }}"><a href="/submit-query">Submit Query</a></li>
          @auth
            <li class="{{ isActiveRoute('profile') }}"><a href="/profile"><i class="fa fa-user icon"></i>Profile</a></li>
            <li>
              <a href="{{ route('logout') }}"
                  onclick="event.preventDefault(); 
                  document.getElementById('logout-form').submit();">
                  <i class="fa fa-reply icon"></i> <!-- #logout-form defined earlier in this page -->
                  {{ __('Logout') }}
              </a>
            </li>
          @endauth
          @guest
            <li class="{{ isActiveRoute('login') }}">
                <a href="/login" class="top-bar-item"><i class="fa fa-sign-in icon"></i>Login</a>
            </li>
            <li class="{{ isActiveRoute('register') }}">
              <a href="/register" class="top-bar-item"><i class="fa fa-user-plus icon"></i>Register</a>
            </li>
          @endauth
          @auth
            @if(Auth::user()->type != 'user')
              <li>
                <a href="/admin" class="top-bar-item" target="_blank"><i class="fa fa-user icon"></i>Admin</a>
              </li>
            @endif
          @endauth
        </ul>
        <div class="clear"></div>

      </div>

      </div><!-- end main menu wrap -->
    </div><!-- end navbar collaspe -->

  </div><!-- end container -->
</header>

@yield('content')

{{-- <footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4 widget footer-widget">
                <a class="footer-logo" href="index.html"><img src="{{ asset('images/logo-white.png')}}" alt="FinfIt" /></a>
                <p>FindIt helps connect owners to their lost documents. Have you lost any of your important documents? Search for it here. If you want to be part of the good deed, all you need to do is create and account with FindfIt and upload that misplaced Id, Driver's License, Passport etc, to our database and connect it to its rightful owner. Help a friend for tomorrow, it could be you.</p>
                <div class="divider"></div>
                <ul class="social-icons circle">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 widget footer-widget from-the-blog">
                <h4><span>From the Blog</span> <img src="{{ asset('client/images/divider-half.png') }}" alt="" /></h4>
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
                <h4><span>Support</span> <img src="images/divider-half.png" alt="" /></h4>
                <p class="footer-phone"><i class="fa fa-phone icon"></i>{{ $admin_on_duty->phone }}</p>
                <p class="footer-phone"><i class="fa fa-envelope icon"></i> findit@24seven.co.ke</p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 widget footer-widget newsletter">
                <h4><span>Navigate</span> <img src="images/divider-half.png" alt="" /></h4>
                <ul>
                    <a href="/"><li>Home</li></a>
                    <a href="/faq"><li>Faq</li></a>
                    <a href="/privacy"><li>privacy</li></a>
                    <a href="/contact-us"><li>Send Query</li></a>
                    <a href=""><li>Logout</li></a>
                </ul>
            </div>
        </div><!-- end row -->
    </div><!-- end footer container -->
</footer> --}}

<div class="bottom-bar">
    <div class="container">
    © {{date('Y')}}  |  find-it | designed and developed by <a target="_blank" href="https://www.24seven.co.ke" target="_blank">24seven Developers</a>  |  All Rights Reserved
    </div>
</div>

<!-- JavaScript file links -->
<!-- <script src="{{ asset('client/js/jquery-3.1.1.min.js') }}"></script>     -->
<script src="{{ asset('client/assets/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
<script src="{{ asset('client/js/bootstrap.min.js') }}"></script>  <!-- bootstrap 3.0 -->
<script src="{{ asset('client/assets/slick-1.6.0/slick.min.js') }}"></script> <!-- slick slider -->
<script src="{{ asset('client/assets/chosen-1.6.2/chosen.jquery.min.js') }}"></script> <!-- chosen - for select dropdowns -->
<script src="{{ asset('client/js/isotope.min.js') }}"></script> <!-- isotope-->
<script src="{{ asset('client/js/wNumb.js') }}"></script> <!-- price formatting -->
<script src="{{ asset('client/js/nouislider.min.js') }}"></script> <!-- price slider -->
<script src="{{ asset('client/js/global.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@include('layouts.messages')
</body>
</html>