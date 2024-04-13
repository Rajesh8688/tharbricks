@extends('front_end.layouts.master')
@section('content')
   <!-- Content -->
   <div class="page-content">
            
    <!-- Banner Area -->
    <div class="aon-page-benner-area">
      <div class="aon-page-banner-row" style="background-image: url({{url('frontEnd/images/banner/job-banner.jpg')}})">
        <div class="sf-overlay-main" style="opacity:0.8; background-color:#022279;"></div>
        <div class="sf-banner-heading-wrap">
          <div class="sf-banner-heading-area">
            <div class="sf-banner-heading-large">Error 404</div>
            <div class="sf-banner-breadcrumbs-nav">
              <ul class="list-inline">
                <li><a href="{{url('/')}}"> Home </a></li>
                <li>Error 404</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Area End -->
    
    <div class="section-full page-notfound-outer p-t120 p-b90">
        <div class="container">
            <div class="section-content">

                <div class="page-notfound">
                    <div class="page-notfound-media">
                        <img src="images/ERROR.png" alt="">
                    </div>
                    <div class="page-notfound-content m-b30">
                        <h3 class="error-comment">The Page You Are Looking For Doesn't Exist...</h3>
                        <p>We Ran Into An Issue, But Don’t Worry, We’ll Take Care Of It For Sure.</p>
                        <a href="{{url('/')}}" class="site-button">Back to Home</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    </div>
    <!-- Content END-->
@endsection    