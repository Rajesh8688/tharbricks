@extends('front_end.layouts.master')
@section('content')
    <!-- Content -->
    <div class="page-content">
        <!--Banner-->
        <div class="aon-page-benner-area">
            <div class="aon-page-banner-row" style="background-image: url({{ asset('frontEnd/images/banner/job-banner.jpg')}})">
            <div class="sf-overlay-main" style="opacity:0.8; background-color:#DF5901;"></div>
            <div class="sf-banner-heading-wrap">
                <div class="sf-banner-heading-area">
                <div class="sf-banner-heading-large">{{__('lang.contact_us')}}</div>
                <div class="sf-banner-breadcrumbs-nav">
                    <ul class="list-inline">
                    <li><a href="{{url('/')}}"> {{__('lang.home')}} </a></li>
                    <li>{{__('lang.contact_us')}}</li>
                    </ul>
                </div>
                </div>
            </div>
            </div>
        </div>            
        <!--Banner-->

        <!-- Contact Us-->
        <div class="aon-contact-area">
            <div class="container">
            <!--Title Section Start-->
            <div class="section-head text-center">
                <h2 class="sf-title">{{__('lang.contact_information')}}</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <!--Title Section End-->

            <div class="section-content">
            
                <div class="sf-contact-info-wrap">  
                <div class="row">
        
                    <!-- COLUMNS 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="sf-contact-info-box">
                            <div class="sf-contact-icon">
                                <span><img src="{{ asset('frontEnd/images/contact-us/1.png')}}" alt=""></span>
                            </div>
                            <div class="sf-contact-info">
                                <h4 class="sf-title">{{__('lang.address')}}</h4>
                                <p>{{$data['address']}}</p>
                            </div>
                        </div>
                    </div>
                    <!-- COLUMNS 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="sf-contact-info-box">
                            <div class="sf-contact-icon">
                                <span><img src="{{ asset('frontEnd/images/contact-us/2.png')}}" alt=""></span>
                            </div>
                            <div class="sf-contact-info">
                                <h4 class="sf-title">{{__('lang.email_info')}}</h4>
                                <p>{{$data['email']}}</p>
                            <br>
                            </div>
                        </div>
                    </div>
                    <!-- COLUMNS 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="sf-contact-info-box">
                            <div class="sf-contact-icon">
                                <span><img src="{{ asset('frontEnd/images/contact-us/3.png')}}" alt=""></span>
                            </div>
                            <div class="sf-contact-info">
                                <h4 class="sf-title">{{__('lang.phone_number')}}</h4>
                                <p>+91 {{$data['phone_number']}} ({{__('lang.support_line')}})</p>
                            <br>
                                
                            </div>
                        </div>
                    </div>
        
                </div>
                </div>

                <div class="sf-contact-form-wrap">
                <!--Contact Information-->  
                <div class="sf-contact-form">
                    <div class="sf-con-form-title text-center">
                        <h2 class="m-b30">{{__('lang.contact_information')}}</h2>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong>  {{session('success')}}
                          </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{session('error')}}
                          </div>
                    @endif
                    <form class="contact-form" method="post" action="{{route('submitContactUs')}}">
                        @csrf
                        <div class="row">
                            
                            <!-- COLUMNS 1 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- COLUMNS 2 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- COLUMNS 3 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="phone" placeholder="Phone" class="form-control  @error('phone') is-invalid @enderror" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- COLUMNS 4 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="subject" placeholder="Subject" class="form-control  @error('subject') is-invalid @enderror" required>
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- COLUMNS 5 -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="message" placeholder="Message" class="form-control @error('message') is-invalid @enderror" required></textarea>
                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            
                            {{-- <div class="col-md-12">
                                <div class="g-recaptcha" data-sitekey="6LeBsyIeAAAAAFfgca0q_h1Dxoy8ekbilrjdBlMf"></div>
                            </div> --}}
                            
                            
                        </div>
                        <div class="sf-contact-submit-btn">
                            <button class="site-button" type="submit">{{__('lang.submit')}}</button>
                        </div>
                    </form>
                </div>
                <!--Contact Information End-->
                </div>              
            </div>

            </div>
        </div>
            
        <!-- Contact Us-->
        <div class="section-full sf-contact-map-area">
            <div class="container">

                <div class="sf-map-social-block text-center">
                    <h2>{{__('lang.trusted_by_thousands_of_people_all_over_the_world')}}</h2>
                    <ul class="sf-con-social">
                        <li><a href="#" class="sf-fb"><img src="{{ asset('frontEnd/images/contact-us/facebook.png')}}" alt="">{{__('lang.facebook')}}</a></li>
                        <li><a href="#" class="sf-twitter"><img src="{{ asset('frontEnd/images/contact-us/twitter.png')}}" alt="">{{__('lang.twitter')}}</a></li>
                        <li><a href="#" class="sf-pinterest"><img src="{{ asset('frontEnd/images/contact-us/pinterest.png')}}" alt="">{{__('lang.pinterest')}}</a></li>
                    </ul>

                    <div class="sf-con-social-pic">
                        <span class="img-pos-1"><img src="{{ asset('frontEnd/images/contact-us/img1.png')}}" alt=""></span>
                        <span class="img-pos-2"><img src="{{ asset('frontEnd/images/contact-us/img2.png')}}" alt=""></span>
                        <span class="img-pos-3"><img src="{{ asset('frontEnd/images/contact-us/img3.png')}}" alt=""></span>
                        <span class="img-pos-4"><img src="{{ asset('frontEnd/images/contact-us/r-img1.png')}}" alt=""></span>
                        <span class="img-pos-5"><img src="{{ asset('frontEnd/images/contact-us/r-img2.png')}}" alt=""></span>
                        <span class="img-pos-6"><img src="{{ asset('frontEnd/images/contact-us/r-img3.png')}}" alt=""></span>
                    </div>
                </div>

            </div>
            <div class="sf-map-wrap">
                <div class="gmap-area">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3887.2100748581593!2d77.69496307507727!3d13.022290187297722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTPCsDAxJzIwLjIiTiA3N8KwNDEnNTEuMSJF!5e0!3m2!1sen!2sin!4v1703182080489!5m2!1sen!2sin" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
            
    </div>
    <!-- Content END-->
@endsection