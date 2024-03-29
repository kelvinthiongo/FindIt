@extends('client.layouts.app')
@section('content')
  <section class="subheader simple-search">
    <div class="container">
      <h1>Have You Lost a Personal Document? </h1>
      <p>Search here with the (national ID, Student ID, NHIF Card, etc) details.</p>
      <p>Search based on the Name, Number, where you suspect you lost your item</p>
      <div>
        <form action="{{ route('search_item') }}" method="get" class="simple-search-form">
          <input type="text" name="content" placeholder="Name/Number/place (eg Kasarani Nairobi)" required/>
          <input type="submit" value="GO" />
        </form>
      </div>
      
  
    </div><!-- end container -->
  </section>
  
  <section class="module services">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <div class="service-item shadow-hover">
            <a href="{{ route('items.create') }}">
              <i class="fa fa-upload"></i>
            </a>
            <a href="{{ route('items.create') }}">
              <h4>Upload Found Document</h4>
            </a>
            <p>Found a misplaced document? Could be a National Id, Student Id, Passport, Driver's License, etc.</p>
            <p>All you need to do is <a href="/register"> <strong>Create</strong></a> an account with us, after which you will be redirected to an upload page where you will upload the item's details. It's That easy. Help a friend for it could be you tomorrow.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="service-item shadow-hover">
            <i class="fa fa-search"></i>
            <h4>Search for a lost Document</h4>
            <p>Have you lost a document? We all know how it feels to lose a personal document and thet's the same reason why FindIt is here.</p>
            <p>All you need to do is enter one of your document's details eg Name, Id Number, Registration Number, Date Lost, or the Place Lost. If your document has been uploaded to our database, we will output the details including where to find it, as well connect you to your Guardian Angel.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="service-item shadow-hover">
            <i class="fa fa-bell"></i>
            <h4>Get Notified If your Document is found</h4>
            <p>Have you searched for your item and found negative results?</p>
            <p>Don't worry for there is still some hope. You can submit your contact details and we will contact you incase someone uploads it to our database.</p>
          </div>
        </div>
      </div><!-- end row -->
    </div><!-- end container -->
  </section>
  <section class="module testimonials">
    <div class="container">
      <div class="module-header">
        <h2>Our <strong>Success Stories</strong></h2>
        <img src="{{ asset('client/images/divider-white.png')}}" alt="" />
        <p>Get to hear from those who have found help from FindIt</p>
      </div>
    </div>
  
    <div class="slider-nav slider-nav-testimonials">
      <span class="slider-prev"><i class="fa fa-angle-left"></i></span>
      <span class="slider-next"><i class="fa fa-angle-right"></i></span>
    </div>
  
    <div class="container">
      <div class="slider slider-testimonials">
        <div class="testimonial slide">
          <h3>"I Recently lost my National Id and upon searching for it here in FindIt, I was connected to my Guardian Angel who had found it for me and decided to keep it safe for me."</h3>
          <div class="testimonial-details">
            <img class="testimonial-img" src="{{ asset('uploads/users/avatar.png')}}" alt="" />
            <p class="testimonial-name"><strong></strong></p>
            <span class="testiomnial-title"><em>Student at <a href="">JKUAT</a></em></span>
          </div>
        </div>
        <div class="testimonial slide">
            <h3>"I Recently lost my National Id and upon searching for it here in FindIt, I was connected to my Guardian Angel who had found it for me and decided to keep it safe for me."</h3>
            <div class="testimonial-details">
              <img class="testimonial-img" src="{{ asset('uploads/users/avatar.png')}}" alt="" />
              <p class="testimonial-name"><strong></strong></p>
              <span class="testiomnial-title"><em>Student </em></span>
            </div>
        </div>
      </div><!-- end slider -->
    </div><!-- end container -->
  </section>
  {{-- <section class="module cta newsletter">
    <div class="container">
      <div class="row">
          <div class="col-lg-7 col-md-7">
              <h3>Sign up for our <strong>newsletter.</strong></h3>
              <p>Lorem molestie odio. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
          </div>
          <div class="col-lg-5 col-md-5">
              <form method="post" id="newsletter-form" class="newsletter-form">
                  <input type="email" placeholder="Your email..." />
                  <button type="submit" form="newsletter-form"><i class="fa fa-send"></i></button>
              </form>
          </div>
      </div><!-- end row -->
    </div><!-- end container -->
  </section> --}}
@endsection