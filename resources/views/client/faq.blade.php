@extends('client.layouts.app')
@section('content')
      <section class="subheader">
        <div class="container">
          <h1>Frequently Asked Questions</h1>
          <div class="breadcrumb right">Home <i class="fa fa-angle-right"></i> <a href="#" class="current">FAQ</a></div>
          <div class="clear"></div>
        </div>
      </section>
      
      <section class="module">
        <div class="container">
      
          <div class="row">
            <div class="col-lg-12 col-md-12"> 
              @if($faqs->count() > 0)
              <div id="accordion" class="content">
                  @foreach ($faqs as $faq)
                    <h3>{{ $faq->question }}</h3>
                    <div>
                      <p>
                      {{ $faq->answer }}
                      </p>
                    </div>
                  @endforeach
              </div>
              @else
              <p>There are no FAQs to display!</p>
              @endif
            </div>
          </div><!-- end row -->
        </div>
    </section>
@endsection