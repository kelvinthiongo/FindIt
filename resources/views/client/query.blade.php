@extends('client.layouts.app')
@section('content')
    <section class="subheader">
        <div class="container">
          <h1>Send Query</h1>
          <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="#" class="current">Send Query</a></div>
          <div class="clear"></div>
        </div>
    </section>
      
      <section class="module contact-details">
        <div class="container">
      
          <div class="row">
            <div class="col-lg-4 col-md-4">
              <div class="contact-item">
                <i class="fa fa-envelope"></i>
                <h4>Email Us</h4>
                <p>findit@24seven.co.ke</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-4">
              <div class="contact-item">
                <i class="fa fa-phone"></i>
                <h4>Call Us</h4>
                <p>Tel: +254700 000 000</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-4">
              <div class="contact-item">
                <i class="fa fa-share-alt"></i>
                <h4>Connect With Us</h4>
                <ul class="social-icons">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                </ul>
              </div>
            </div>
          </div><!-- end row -->
      
        </div>
      </section>
      
      <section class="module">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12">
      
              <div class="comment-form">
                <h4><span>Quick Contact</span> <img src="{{ asset('client/images/divider-half.png') }}" alt="" /></h4>
                <p><b>Fill out the form below.</b> Describe your query in the form below and FindIt support team will attend to your query. Everything with an asterisk is mandatory.</p>
                
                <form method="" id="contact-us">
                  <div class="form-block">
                    <label>
                      Name *
                    </label>
                    <input class="requiredField" type="text" placeholder="Your Name" name="name" value="" />
                  </div>
                  <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="form-block">
                        <label>
                          Email *
                        </label>
                        <input class="email requiredField" type="text" placeholder="Your email" name="email" value="" />
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                      <div class="form-block">
                        <label>Phone</label>
                        <input type="text" placeholder="Your phone" name="phone" value="" />
                      </div>
                    </div>
                  </div>
                  <div class="form-block">
                        <label>Subject</label>
                        <input type="text" placeholder="Subject" name="subject" value="" />
                      </div>
                  <div class="form-block">
                    <label>
                      Message *
                    </label>
                    <textarea class="requiredField" placeholder="Your message..." name="message"></textarea>
                  </div>
                  <div class="form-block">
                    <input type="submit" value="Submit" />
                    <input type="hidden" name="submitted" id="submitted" value="true" />
                  </div>
                </form>
              </div>
      
              <div class="divider"></div><br/>
              <h4>Still need help?</h4>
              <p>If you still have questions, try visiting our <a href="/faq"><b>FAQ</b></a> page to assit you. This is where we have compiled most of the issues inquired by people.</p>
      
            </div>
          </div><!-- end row -->
      
        </div><!-- end container -->
      </section>
@endsection