@extends('front_end.layouts.master')
@section('extrastyle')
    <link rel="stylesheet" href="{{ asset('frontEnd/css/image-radio-master/bootstrap-image-checkbox.css')}}">
    <link rel="stylesheet" href="{{ asset('frontEnd/css/chosen.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
@section('content')
    <!-- CONTENT START -->
    <div class="page-content">
        
        
        <!-- BANNER SECTION START -->
        <section class="aon-banner-area2">
            <!--banner 2-->
            <div class="container">
                <div class="aone-banner-area2-inner">
                    <div class="row d-flex align-items-center">
                        <!--Banner Left-->
                        <div class="col-lg-5 col-md-12">
                            <div class="aon-bnr2-content-wrap">
                                <!--Banner Text-->
                                <div class="aon-bnr-write">
                                    <h2 class="text-top-line">Hire 
                                        <span class="text-secondry">Experts</span> &amp; 
                                    </h2>
                                    <h2 class="text-bot-line">Get Your Job Done</h2>
                                </div>
                                <!--Banner Text End-->
                                <!--Seach Bar-->
                                <div class="aon-bnr2-search-bar">
                                    <form>
                                        <div class="aon-bnr2-search-box">
                                            
                                            <!-- COLUMNS 1 -->
                                            <div class="aon-search-input category-select">
                                                <select id="categorysrh" name="catid" class="form-control sf-form-control aon-categories-select sf-select-box" title="Category">
                                                    <option class="bs-title-option" value="">Select a Category</option>

                                                    @foreach ($Categories as $category)
                                                    {{$icon = asset('uploads/categories/icons/'.$category->icon)}}
                                                
                                                    
                                                    <option value="{{$category->id}}" data-content="<img class='childcat-img' width='50' height='auto' style='border-radius: 5px !important' src={{$icon}}>
                                                    
                                                        <span class='childcat'>{{$category->name}}</span>">{{$category->name}}</option>
                                                        
                                                    @endforeach
                                                                                                    
                                                </select>
                                            </div>
                                            <!-- COLUMNS 2 -->
                                            <div class="aon-search-input keywords-input">
                                                <input type="text" placeholder="Search pincode" class="form-control">
                                            </div>
                                            <!-- COLUMNS 3 -->
                                            <div class="aon-search-btn-wrap">
                                                <button class="aon-search-btn" type="submit">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--Seach Bar End-->
                            </div>
                        </div>
                        <!--Banner Right-->
                        <div class="col-lg-7 col-md-12">
                            <div class="aon-bnr2-media-wrap">
                                <!-- COLUMNS 1 -->
                                <div class="aon-bnr2-media">
                                    <img src="{{asset('frontEnd/images/banner2/1.png')}}" alt="">
                                </div>
                                <!-- COLUMNS 2 -->
                                <div class="aon-bnr2-lines-left">
                                    <div class="aon-bnr2-line-left-content">
                                        <img src="{{asset('frontEnd/images/banner2/line-left.png')}}" alt="">
                                        <span class="circle-l-1 slide-fwd-center"></span>
                                        <span class="circle-l-2 slide-fwd-center2"></span>
                                        <span class="circle-l-3 slide-fwd-center3"></span>
                                    </div>
                                </div>
                                <!-- COLUMNS 3 -->
                                <div class="aon-bnr2-lines-right">
                                    <img src="{{asset('frontEnd/images/banner2/line-right.png')}}" alt="">
                                    <span class="circle-r-1 slide-fwd-center3"></span>
                                    <span class="circle-r-2 slide-fwd-center2"></span>
                                    <span class="circle-r-3 slide-fwd-center"></span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!--banner 2-->
        </section>
        <!-- BANNER SECTION END --> 
            
            
        <!-- Services Finder categories -->
        <section class="bg-white aon-categories-area2">
            <div class="container">
                <!--Title Section Start-->
                <div class="section-head">
                    <div class="row">
                        <!-- COLUMNS LEFT -->
                        <div class="col-lg-6 col-md-12">
                            <span class="aon-sub-title">categories</span>
                            <h2 class="sf-title">Popular Categories</h2>
                        </div>
                        <!-- COLUMNS RIGHT -->
                        <div class="col-lg-6 col-md-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <!--Title Section End-->
                    
                <div class="section-content">
                    <div class="aon-categories-area2-section">
                        <div class="row justify-content-center">
                            @foreach ($Categories as $item)
                            <div class="col-lg-4 col-md-6" >
                                <div class="media-bg-animate mba-bdr-15" >
                                    <div class="aon-categories-area2-iconbox aon-icon-effect" onclick="QuestionsModel({{$item->id}} ,'{{$item->name}}')">
                                        <div class="aon-cate-area2-icon">
                                            <span>
                                                <i class="aon-icon"><img src="{{asset('uploads/categories/icons/'.$item->icon)}}" alt=""></i>
                                            </span>
                                        </div>
                                        <div class="aon-cate-area2-content">
                                            {{-- <h4 class="aon-tilte"><a href="{{route('categoryDetails',['slug'=>$item->slug])}}">{{$item->name}}</a></h4> --}}
                                            <h4 class="aon-tilte">{{$item->name}}</h4>
                                            <p>0 Listing</p>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                                
                            @endforeach
                            
                        </div>
                        <div class="aon-btn-pos-center">
                            <a class="site-button" href="{{route('category')}}">View All</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!-- Services Finder categories END -->

        <!-- How It Work -->
        <section class="aon-howit-area2">
            <div class="container">

                <div class="aon-howit-area2-section">
                    <div class="aon-howit-area2-bg">
                        <!--Title Section Start-->
                        <div class="section-head aon-title-center white">
                            <span class="aon-sub-title">Stpes</span>
                            <h2 class="sf-title">How It Work</h2>
                        </div>
                        <!--Title Section Start End-->
                        <div class="section-content">
                            <div class="aon-categories-area2-section">
                                <div class="row justify-content-center">
                                    <!-- Block 1-->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="aon-howit-area2-iconbox aon-icon-effect">
                                            <div class="aone-howit-number">01</div>
                                            <div class="aon-howit-area2-icon">
                                                <span>
                                                    <i class="aon-icon"><img src="{{asset('frontEnd/images/step-icon/1.png')}}" alt=""></i>
                                                </span>
                                            </div>
                                            <div class="aon-howit-area2-content">
                                                <h4 class="aon-tilte">Describe Your Task</h4>
                                                <p>This helps us determine which Taskers We are abest jobs.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Block 2-->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="aon-howit-area2-iconbox aon-howit-arrow aon-icon-effect">
                                            <div class="aone-howit-number">02</div>
                                            <div class="aon-howit-area2-icon">
                                                <span>
                                                    <i class="aon-icon"><img src="{{asset('frontEnd/images/step-icon/2.png')}}" alt=""></i>
                                                </span>
                                            </div>
                                            <div class="aon-howit-area2-content">
                                                <h4 class="aon-tilte">Choose a Tasker</h4>
                                                <p>This helps us determine which Taskers We are abest jobs.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Block 3-->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="aon-howit-area2-iconbox aon-icon-effect">
                                            <div class="aone-howit-number">03</div>
                                            <div class="aon-howit-area2-icon">
                                                <span>
                                                    <i class="aon-icon"><img src="{{asset('frontEnd/images/step-icon/3.png')}}" alt=""></i>
                                                </span>
                                            </div>
                                            <div class="aon-howit-area2-content">
                                                <h4 class="aon-tilte">Live Smarter</h4>
                                                <p>This helps us determine which Taskers We are abest jobs.</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!-- How It Work END --> 
        
        
        <!-- Featued Vender -->
        <section class="section-full aon-feature-vender-area2">
            <div class="container">
                <!--Title Section Start-->
                <div class="section-head">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <span class="aon-sub-title">Vendor</span>
                            <h2 class="sf-title">Featured Providers</h2>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <!--Title Section Start-->
                <div class="section-content">
                    <div class="owl-carousel aon-vendor-provider-two-carousel aon-owl-arrow">

                        <!-- COLUMNS 1 -->
                        <div class="item">
                            <div class="aon-ow-provider-wrap2">
                                <div class="aon-ow-provider2 shine-hover">

                                    <div class="aon-ow-top">
                                        <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="aon-ow-info">
                                            <h4 class="sf-title"><a href="profile-full.html">Javier Bardem</a></h4>
                                            <span>Queens, United States</span>
                                        </div>
                                    </div>
                                    <div class="aon-ow-mid">
                                        <div class="aon-ow-media media-bg-animate">
                                            <a class="shine-box" href="profile-full.html"><img src="{{asset('frontEnd/images/providers/1.jpg')}}" alt=""></a>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="aon-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <div class="aon-ow-bottom">
                                            <a href="profile-full.html" class="site-button">Request A Quote</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- COLUMNS 2 -->
                        <div class="item">
                            <div class="aon-ow-provider-wrap2">
                                <div class="aon-ow-provider2 shine-hover">

                                    <div class="aon-ow-top">
                                        <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="aon-ow-info">
                                            <h4 class="sf-title"><a href="profile-full.html">Mila Kunis</a>
                                            </h4>
                                            <span>Queens, United States</span>
                                        </div>
                                    </div>
                                    <div class="aon-ow-mid">
                                        <div class="aon-ow-media media-bg-animate">
                                            <a class="shine-box" href="profile-full.html"><img src="{{asset('frontEnd/images/providers/2.jpg')}}" alt=""></a>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="aon-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <div class="aon-ow-bottom">
                                            <a href="profile-full.html" class="site-button">Request A Quote</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- COLUMNS 3 -->
                        <div class="item">
                            <div class="aon-ow-provider-wrap2">
                                <div class="aon-ow-provider2 shine-hover">

                                    <div class="aon-ow-top">
                                        <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="aon-ow-info">
                                            <h4 class="sf-title"><a href="profile-full.html">Edward Luise</a>
                                            </h4>
                                            <span>Queens, United States</span>
                                        </div>
                                    </div>
                                    <div class="aon-ow-mid">
                                        <div class="aon-ow-media media-bg-animate">
                                            <a class="shine-box" href="profile-full.html"><img src="{{asset('frontEnd/images/providers/3.jpg')}}" alt=""></a>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="aon-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <div class="aon-ow-bottom">
                                            <a href="profile-full.html" class="site-button">Request A Quote</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div> 
                        </div>
                        <!-- COLUMNS 4 -->
                        <div class="item">
                            <div class="aon-ow-provider-wrap2">
                                <div class="aon-ow-provider2 shine-hover">

                                    <div class="aon-ow-top">
                                        <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="aon-ow-info">
                                            <h4 class="sf-title"><a href="profile-full.html">James McAvoy</a></h4>
                                            <span>Queens, United States</span>
                                        </div>
                                    </div>
                                    <div class="aon-ow-mid">
                                        <div class="aon-ow-media media-bg-animate">
                                            <a class="shine-box" href="profile-full.html"><img src="{{asset('frontEnd/images/providers/1.jpg')}}" alt=""></a>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="aon-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <div class="aon-ow-bottom">
                                            <a href="profile-full.html" class="site-button">Request A Quote</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div> 
                        </div>
                        <!-- COLUMNS 5 -->
                        <div class="item">
                            <div class="aon-ow-provider-wrap2">
                                <div class="aon-ow-provider2 shine-hover">

                                    <div class="aon-ow-top">
                                        <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="aon-ow-info">
                                            <h4 class="sf-title"><a href="profile-full.html">Jackie Chan</a></h4>
                                            <span>Queens, United States</span>
                                        </div>
                                    </div>
                                    <div class="aon-ow-mid">
                                        <div class="aon-ow-media media-bg-animate">
                                            <a class="shine-box" href="profile-full.html"><img src="{{asset('frontEnd/images/providers/2.jpg')}}" alt=""></a>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="aon-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <div class="aon-ow-bottom">
                                            <a href="profile-full.html" class="site-button">Request A Quote</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- COLUMNS 6 -->
                        <div class="item">
                            <div class="aon-ow-provider-wrap2">
                                <div class="aon-ow-provider2 shine-hover">

                                    <div class="aon-ow-top">
                                        <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="aon-ow-info">
                                            <h4 class="sf-title"><a href="profile-full.html">Colin Farrell</a></h4>
                                            <span>Queens, United States</span>
                                        </div>
                                    </div>
                                    <div class="aon-ow-mid">
                                        <div class="aon-ow-media media-bg-animate">
                                            <a class="shine-box" href="profile-full.html"><img src="{{asset('frontEnd/images/providers/3.jpg')}}" alt=""></a>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="aon-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <div class="aon-ow-bottom">
                                            <a href="profile-full.html" class="site-button">Request A Quote</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
        </section>
        <!-- Featued Vender End -->
            
            
        <!-- Why Choose us -->
        <section class="aon-why-choose2-area">
            <div class="container">

                <div class="aon-why-choose2-box">
                    <div class="row">
                        <!-- COLUMNS LEFT -->
                        <div class="col-lg-6 col-md-12">
                            <div class="aon-why-choose-info">
                                <!--Title Section Start-->
                                <div class="section-head">
                                    <span class="aon-sub-title">Choose</span>
                                    <h2 class="aon-title">Why Choose us</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                                <!--Title Section Start End-->

                                <ul class="aon-why-choose-steps list-unstyled">
                                    <!-- COLUMNS 1 -->
                                    <li class="d-flex">
                                        <div class="aon-w-choose-left aon-icon-effect">
                                            <div class="aon-w-choose-icon"><i class="aon-icon"><img src="{{asset('frontEnd/images/whychoose/1.png')}}" alt=""></i></div>
                                        </div>
                                        <div class="aon-w-choose-right">
                                            <h4 class="aon-title">Meet new customers</h4>
                                            <p>Suspendisse tincidunt rutrum ante. Vestibulum elementum ipsum sit amet turpis elementum lobortis.</p>
                                        </div>
                                    </li>
                                    <!-- COLUMNS 2 -->
                                    <li class="d-flex">
                                        <div class="aon-w-choose-left aon-icon-effect">
                                            <div class="aon-w-choose-icon"><i class="aon-icon"><img src="{{asset('frontEnd/images/whychoose/2.png')}}" alt=""></i></div>
                                        </div>
                                        <div class="aon-w-choose-right">
                                            <h4 class="aon-title">Grow your revenue</h4>
                                            <p>Suspendisse tincidunt rutrum ante. Vestibulum elementum ipsum sit amet turpis elementum lobortis.</p>
                                        </div>
                                    </li>
                                    <!-- COLUMNS 3 -->
                                    <li class="d-flex">
                                        <div class="aon-w-choose-left aon-icon-effect">
                                            <div class="aon-w-choose-icon"><i class="aon-icon"><img src="{{asset('frontEnd/images/whychoose/3.png')}}" alt=""></i></div>
                                        </div>
                                        <div class="aon-w-choose-right">
                                            <h4 class="aon-title">Build your online reputation</h4>
                                            <p>Suspendisse tincidunt rutrum ante. Vestibulum elementum ipsum sit amet turpis elementum lobortis.</p>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <!-- COLUMNS RIGHT -->
                        <div class="col-lg-6 col-md-12">
                            <div class="aon-why-choose2-line">
                                <div class="aon-why-choose2-pic"></div>
                            </div>     
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!-- Why Choose us END -->            
            

        <!-- Recently Posted Jobs -->
        <div class="section-full aon-postjobs-area2">
            <div class="container">
                <!--Title Section Start-->
                <div class="section-head">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <span class="aon-sub-title">Jobs</span>
                            <h2 class="sf-title">Recently Posted Jobs</h2>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
                
                {{-- <div class="section-content">
                    <div class="aon-postjobs-area2-section">
                        <div class="row">
                            <!-- COLUMNS 1 -->
                            <div class="col-lg-6 col-md-6">
                                <div class="aon-post-jobsCol media-bg-animate mba-bdr-15">
                                    <div class="aon-post-jobs2 aon-icon-effect">

                                        <div class="job-comapny-logo">
                                            <img class="company_logo aon-icon" src="{{asset('frontEnd/images/jobs/1.jpg')}}" alt="">
                                        </div>
                                        <div class="job-comapny-info">
                                            <div class="position">
                                                <h3><a href="job-detail.html">UI & UX Designer</a></h3>
                                                <div class="company"><strong>Digital Asset</strong></div>
                                            </div>

                                            <ul class="meta">
                                                <li class="job-type hourly"><i class="fa fa-circle"></i>Full Time</li>
                                            </ul>

                                            <div class="job-date">
                                                <span><i class="fa fa-calendar-o"></i>  3 years ago</span>
                                            </div>

                                            <div class="job-location">
                                                <i class="fa fa-map-marker"></i> Brooklyn 
                                            </div>
                                            <div class="job-amount">
                                                <i class="fa fa-money"></i>
                                                <span>$1,200 - $1,500</span>
                                            </div>
                                            <div class="job-label"><img src="{{asset('frontEnd/images/label.png')}}" alt=""></div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- COLUMNS 2 -->
                            <div class="col-lg-6 col-md-6">
                                <div class="aon-post-jobsCol media-bg-animate mba-bdr-15">
                                    <div class="aon-post-jobs2 aon-icon-effect">
                                        <div class="job-comapny-logo">
                                            <img class="company_logo aon-icon" src="{{asset('frontEnd/images/jobs/2.jpg')}}" alt="">
                                        </div>
                                        <div class="job-comapny-info">
                                            <div class="position">
                                                <h3><a href="job-detail.html">Web & App developer</a></h3>
                                                <div class="company"><strong>Digital Asset</strong></div>
                                            </div>

                                            <ul class="meta">
                                                <li class="job-type hourly"><i class="fa fa-circle"></i>Hourly</li>
                                            </ul>

                                            <div class="job-date">
                                                <span><i class="fa fa-calendar-o"></i>  3 years ago</span>
                                            </div>
                                            <div class="job-location">
                                                <i class="fa fa-map-marker"></i> Brooklyn 
                                            </div>
                                            <div class="job-amount">
                                                <i class="fa fa-money"></i>
                                                <span>$1,200 - $1,500</span>
                                            </div>
                                            <div class="job-label"><img src="{{asset('frontEnd/images/label.png')}}" alt=""></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COLUMNS 3 -->
                            <div class="col-lg-6 col-md-6">
                                <div class="aon-post-jobsCol media-bg-animate mba-bdr-15">
                                    <div class="aon-post-jobs2 aon-icon-effect">
                                        <div class="job-comapny-logo">
                                            <img class="company_logo aon-icon" src="{{asset('frontEnd/images/jobs/3.jpg')}}" alt="">
                                        </div>
                                        <div class="job-comapny-info">
                                            <div class="position">
                                                <h3><a href="job-detail.html">Hotel Interior Designer</a></h3>
                                                <div class="company"><strong>Digital Asset</strong></div>
                                            </div>

                                            <ul class="meta">
                                                <li class="job-type hourly"><i class="fa fa-circle"></i>Hourly</li>
                                            </ul>

                                            <div class="job-date">
                                                <span><i class="fa fa-calendar-o"></i>  3 years ago</span>
                                            </div>
                                            <div class="job-location">
                                                <i class="fa fa-map-marker"></i> Brooklyn 
                                            </div>
                                            <div class="job-amount">
                                                <i class="fa fa-money"></i>
                                                <span>$1,200 - $1,500</span>
                                            </div>
                                            <div class="job-label"><img src="{{asset('frontEnd/images/label.png')}}" alt=""></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COLUMNS 4 -->
                            <div class="col-lg-6 col-md-6">
                                <div class="aon-post-jobsCol media-bg-animate mba-bdr-15">
                                    <div class="aon-post-jobs2 aon-icon-effect">
                                        <div class="job-comapny-logo">
                                            <img class="company_logo aon-icon" src="{{asset('frontEnd/images/jobs/4.jpg')}}" alt="">
                                        </div>
                                        <div class="job-comapny-info">
                                            <div class="position">
                                                <h3><a href="job-detail.html">Digital Marketing Agency</a></h3>
                                                <div class="company"><strong>Digital Asset</strong></div>
                                            </div>

                                            <ul class="meta">
                                                <li class="job-type hourly"><i class="fa fa-circle"></i>Hourly</li>
                                            </ul>

                                            <div class="job-date">
                                                <span><i class="fa fa-calendar-o"></i> 3 years ago</span>
                                            </div>
                                            <div class="job-location">
                                                <i class="fa fa-map-marker"></i> Brooklyn 
                                            </div>
                                            <div class="job-amount">
                                                <i class="fa fa-money"></i>
                                                <span>$1,200 - $1,500</span>
                                            </div>
                                            <div class="job-label"><img src="{{asset('frontEnd/images/label.png')}}" alt=""></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COLUMNS 5 -->
                            <div class="col-lg-6 col-md-6">
                                <div class="aon-post-jobsCol media-bg-animate mba-bdr-15">
                                    <div class="aon-post-jobs2 aon-icon-effect">
                                        <div class="job-comapny-logo">
                                            <img class="company_logo ao-icon" src="{{asset('frontEnd/images/jobs/5.jpg')}}" alt="">
                                        </div>
                                        <div class="job-comapny-info">
                                            <div class="position">
                                                <h3><a href="job-detail.html">Fish & Game Warden</a></h3>
                                                <div class="company"><strong>Digital Asset</strong></div>
                                            </div>

                                            <ul class="meta">
                                                <li class="job-type hourly"><i class="fa fa-circle"></i>Hourly</li>
                                            </ul>

                                            <div class="job-date">
                                                <span><i class="fa fa-calendar-o"></i> 3 years ago</span>
                                            </div>
                                            <div class="job-location">
                                                <i class="fa fa-map-marker"></i> Brooklyn 
                                            </div>
                                            <div class="job-amount">
                                                <i class="fa fa-money"></i>
                                                <span>$1,200 - $1,500</span>
                                            </div>
                                            <div class="job-label"><img src="{{asset('frontEnd/images/label.png')}}" alt=""></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COLUMNS 6 -->
                            <div class="col-lg-6 col-md-6">
                                <div class="aon-post-jobsCol media-bg-animate mba-bdr-15">
                                    <div class="aon-post-jobs2 aon-icon-effect">
                                        <div class="job-comapny-logo">
                                            <img class="company_logo aon-icon" src="{{asset('frontEnd/images/jobs/6.jpg')}}" alt="">
                                        </div>
                                        <div class="job-comapny-info">
                                            <div class="position">
                                                <h3><a href="job-detail.html">Certified Nursing Assistant</a></h3>
                                                <div class="company"><strong>Digital Asset</strong></div>
                                            </div>

                                            <ul class="meta">
                                                <li class="job-type hourly"><i class="fa fa-circle"></i>Hourly</li>
                                            </ul>

                                            <div class="job-date">
                                                <span><i class="fa fa-calendar-o"></i> 3 years ago</span>
                                            </div>
                                            <div class="job-location">
                                                <i class="fa fa-map-marker"></i> Brooklyn 
                                            </div>
                                            <div class="job-amount">
                                                <i class="fa fa-money"></i>
                                                <span>$1,200 - $1,500</span>
                                            </div>
                                            <div class="job-label"><img src="{{asset('frontEnd/images/label.png')}}" alt=""></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
        <!-- Recently Posted Jobs Section END -->


        <!-- Pricing Plan -->
        <div class="section-full aon-pricing-area2" id= "pricing">
            <div class="container">
                <!--Title Section Start-->
                <div class="section-head">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <span class="aon-sub-title">Pricing</span>
                            <h2 class="sf-title">Our Pricing Plans</h2>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
                
                <div class="section-content">
                    <div class="aon-priceing-tb-control">
                        <span>Bill Monthly</span>
                        <label class="switch">
                            <input type="checkbox" name="planType" id ="planType">
                            <span class="slider round"></span>
                        </label>
                        <span>Bill Yearly</span>
                    </div>
                    <div class="sf-pricing-section-outer">
                        <div class="row no-gutter">
                            @foreach ($Plans as $p=>$plan)
                            <div class="col-md-3">
                                <div class="sf-pricing-section {{$p== 0 ? 'sf-pricing-active' : ''}} pricing" >

                                    <div class="sf-price-tb-info">
                                        <div class="sf-price-plan-name">{{$plan->name}}</div>
                                        <div class="sf-price-plan-discount">Save 20%</div>
                                    </div>

                                    <div class="sf-price-tb-list" style="height: 150px;">
                                        <ul>
                                            @foreach ($plan->Details as $detail)
                                            <li><i class="fa fa-check"></i> {{$detail->title}}</li>
                                            @endforeach
                                            
                                            {{-- <li><i class="fa fa-check"></i> Booking</li>
                                            <li><i class="fa fa-check"></i> Own Cover Image</li>
                                            <li class="disable"><i class="fa fa-check"></i> Multiple Categories</li>
                                            <li class="disable"><i class="fa fa-check"></i> Apply for Job</li>
                                            <li class="disable"><i class="fa fa-check"></i> Job Alerts</li>
                                            <li class="disable"><i class="fa fa-check"></i> Google Calendar</li>
                                            <li class="disable"><i class="fa fa-check"></i> Crop Profile Image</li> --}}
                                        </ul>
                                    </div>

                                    <div class="sf-price-tb-plan">
                                        <div class="sf-price-plan-cost PlanAmountmonthly" >
                                            ₹<span >{{$plan->monthly_amount}}</span>/month
                                        </div>
                                        <div class="sf-price-plan-cost PlanAmountyearly"  style="display:none">
                                            ₹<span >{{$plan->yearly_amount}}</span>/year
                                        </div>
                                    </div>
                                    <a href="contact-us.html" class="sf-choose-plan-btn">Choose Plan</a>
                                </div>
                            </div>
                                
                            @endforeach
                            <!-- COLUMNS 1 -->
                            {{-- <div class="col-md-3">
                                <div class="sf-pricing-section">

                                    <div class="sf-price-tb-info">
                                        <div class="sf-price-plan-name">Intro</div>
                                        <div class="sf-price-plan-discount">Save 20%</div>
                                    </div>

                                    <div class="sf-price-tb-list">
                                        <ul>
                                            <li><i class="fa fa-check"></i> Booking</li>
                                            <li><i class="fa fa-check"></i> Own Cover Image</li>
                                            <li class="disable"><i class="fa fa-check"></i> Multiple Categories</li>
                                            <li class="disable"><i class="fa fa-check"></i> Apply for Job</li>
                                            <li class="disable"><i class="fa fa-check"></i> Job Alerts</li>
                                            <li class="disable"><i class="fa fa-check"></i> Google Calendar</li>
                                            <li class="disable"><i class="fa fa-check"></i> Crop Profile Image</li>
                                        </ul>
                                    </div>

                                    <div class="sf-price-tb-plan">
                                        <div class="sf-price-plan-cost">$<span>29</span>/month</div>
                                    </div>
                                    <a href="contact-us.html" class="sf-choose-plan-btn">Choose Plan</a>
                                </div>
                            </div> --}}
                            <!-- COLUMNS 2 -->
                            {{-- <div class="col-md-3">
                                <div class="sf-pricing-section">

                                    <div class="sf-price-tb-info">
                                        <div class="sf-price-plan-name">Base</div>
                                        <div class="sf-price-plan-discount">Save 20%</div>
                                    </div>

                                    <div class="sf-price-tb-list">
                                        <ul>
                                            <li><i class="fa fa-check"></i> Booking</li>
                                            <li><i class="fa fa-check"></i> Own Cover Image</li>
                                            <li><i class="fa fa-check"></i> Multiple Categories</li>
                                            <li><i class="fa fa-check"></i> Apply for Job</li>
                                            <li><i class="fa fa-check"></i> Job Alerts</li>
                                            <li class="disable"><i class="fa fa-check"></i> Google Calendar</li>
                                            <li class="disable"><i class="fa fa-check"></i> Crop Profile Image</li>
                                        </ul>
                                    </div>

                                    <div class="sf-price-tb-plan">
                                        <div class="sf-price-plan-cost">$<span>39</span>/month</div>
                                    </div>
                                    <a href="#" class="sf-choose-plan-btn">Choose Plan</a>
                                </div>
                            </div> --}}
                            <!-- COLUMNS 3 -->
                            {{-- <div class="col-md-3">
                                <div class="sf-pricing-section sf-pricing-active">

                                    <div class="sf-price-tb-info">
                                        <div class="sf-price-plan-name">Pro</div>
                                        <div class="sf-price-plan-discount">Save 20%</div>
                                    </div>

                                    <div class="sf-price-tb-list">
                                        <ul>
                                            <li><i class="fa fa-check"></i> Booking</li>
                                            <li><i class="fa fa-check"></i> Own Cover Image</li>
                                            <li><i class="fa fa-check"></i> Multiple Categories</li>
                                            <li><i class="fa fa-check"></i> Apply for Job</li>
                                            <li><i class="fa fa-check"></i> Job Alerts</li>
                                            <li><i class="fa fa-check"></i> Google Calendar</li>
                                            <li><i class="fa fa-check"></i> Crop Profile Image</li>
                                        </ul>
                                    </div>

                                    <div class="sf-price-tb-plan">
                                        <div class="sf-price-plan-cost">$<span>49</span>/month</div>
                                    </div>
                                    <a href="contact-us.html" class="sf-choose-plan-btn">Try 1 Month</a>
                                </div>
                            </div> --}}
                            <!-- COLUMNS 4 -->
                            {{-- <div class="col-md-3">
                                <div class="sf-pricing-section">

                                    <div class="sf-price-tb-info">
                                        <div class="sf-price-plan-name">Enterprise</div>
                                        <div class="sf-price-plan-discount">Save 20%</div>
                                    </div>

                                    <div class="sf-price-tb-list">
                                        <ul>
                                            <li><i class="fa fa-check"></i> Booking</li>
                                            <li><i class="fa fa-check"></i> Own Cover Image</li>
                                            <li><i class="fa fa-check"></i> Multiple Categories</li>
                                            <li><i class="fa fa-check"></i> Apply for Job</li>
                                            <li><i class="fa fa-check"></i> Job Alerts</li>
                                            <li><i class="fa fa-check"></i> Google Calendar</li>
                                            <li><i class="fa fa-check"></i> Crop Profile Image</li>
                                        </ul>
                                    </div>

                                    <div class="sf-price-tb-plan">
                                        <div class="sf-price-plan-cost">$<span>89</span>/month</div>
                                    </div>
                                    <a href="contact-us.html" class="sf-choose-plan-btn">Choose Plan</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Pricing Plan END --> 

        <!-- Latest Blog -->
        <div class="section-full aon-latest-blog-area2">
            <div class="container">
                <!--Title Section Start-->
                <div class="section-head">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <span class="aon-sub-title">Blog</span>
                            <h2 class="sf-title">Latest News</h2>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>

                <div class="section-content">
                    <div class="aon-l-blog-area2-section">
                        <div class="row d-flex justify-content-center">
                            <!-- COLUMNS 1 -->
                            <div class="col-lg-4 col-md-6 shine-hover">
                                <div class="aon-blog-style-1 media-bg-animate mba-bdr-20">
                                    <div class="post-bx">
                                        <!-- Content section for blogs start -->
                                        <div class="post-thum shine-box"> 
                                            <img title="title" alt="" src="{{asset('frontEnd/images/blog/blog-grid/1.jpg')}}">
                                        </div>
                                        <div class="post-info">
                                            <div class="post-categories"><a href="#">Logistics</a></div>
                                            <div class="post-meta">
                                            <ul>
                                                <li class="post-date"><span>June 18, 2022</span></li>
                                                <li class="post-author">By
                                                <a href="#" title="Posts by admin" rel="author">Nina Brown</a>
                                                </li>
                                                
                                            </ul>
                                            </div>
                                                                                
                                            <div class="post-text">
                                            <h4 class="post-title">
                                                <a href="blog-detail.html">Helping Companies in  Their Green Transition</a>
                                            </h4>
                                            </div>
                                            
                                        </div>
                                        <!-- Content section for blogs end -->
                                    </div>
                                </div>
                            </div>
                            <!-- COLUMNS 2 -->
                            <div class="col-lg-4 col-md-6 shine-hover">
                                <div class="aon-blog-style-1 media-bg-animate mba-bdr-20">
                                    <div class="post-bx">
                                        <!-- Content section for blogs start -->
                                        <div class="post-thum shine-box"> 
                                            <img title="title" alt="" src="{{asset('frontEnd/images/blog/blog-grid/2.jpg')}}">
                                        </div>
                                        <div class="post-info">
                                            <div class="post-categories"><a href="#">Business</a></div>
                                            <div class="post-meta">
                                            <ul>
                                                <li class="post-date"><span>June 18, 2022</span></li>
                                                <li class="post-author">By
                                                <a href="#" title="Posts by admin" rel="author">Nina Brown</a>
                                                </li>
                                                
                                            </ul>
                                            </div>
                                                                                
                                            <div class="post-text">
                                            <h4 class="post-title">
                                                <a href="blog-detail.html">There are two thing is very important in Consectetur</a>
                                            </h4>
                                            </div>
                                            
                                        </div>
                                        <!-- Content section for blogs end -->
                                    </div>
                                </div>
                            </div>
                            <!-- COLUMNS 3 -->
                            <div class="col-lg-4 col-md-6 shine-hover">
                                <div class="aon-blog-style-1 media-bg-animate mba-bdr-20">
                                    <div class="post-bx">
                                        <!-- Content section for blogs start -->
                                        <div class="post-thum shine-box"> 
                                            <img title="title" alt="" src="{{asset('frontEnd/images/blog/blog-grid/3.jpg')}}">
                                        </div>
                                        <div class="post-info">
                                            <div class="post-categories"><a href="#">Traveling</a></div>
                                            <div class="post-meta">
                                            <ul>
                                                <li class="post-date"><span>June 18, 2022</span></li>
                                                <li class="post-author">By
                                                <a href="#" title="Posts by admin" rel="author">Nina Brown</a>
                                                </li>
                                                
                                            </ul>
                                            </div>
                                                                                
                                            <div class="post-text">
                                            <h4 class="post-title">
                                                <a href="blog-detail.html">Officia deserunt mollit anim id est labrum. duis</a>
                                            </h4>
                                            </div>
                                            
                                        </div>
                                        <!-- Content section for blogs end -->
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Latest Blog END -->
            
        <!-- Testimonials Two -->
        <section class="bg-white aon-testimonials-two-area">
            <div class="aon-half-bg"></div>
            <div class="container">
                <!--Title Section Start-->
                <div class="section-head">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <span class="aon-sub-title">Testimonials</span>
                            <h2 class="aon-title">What People Say</h2>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
                    
                <div class="section-content">
                    <div class="owl-carousel testimonials-two-carousel-owl aon-owl-arrow">
                        <!-- COLUMNS 1 -->
                        <div class="item">
                            <div class="aon-test2-item">
                                <div class="aon-test2-pic"><img src="{{asset('frontEnd/images/testimonials2/pic1.jpg')}}" alt=""/></div>
                                <h3 class="aon-test2-name">David Smith</h3>
                                <div class="aon-test2-position">Web Designer</div>
                                <div class="aon-test2-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore.</div>
                                <div class="aon-test2-animate">
                                    <span class="aon-test2-circle1"></span>
                                    <span class="aon-test2-square1"></span>
                                    <span class="aon-test2-square2"></span>
                                    <span class="aon-test2-circle2"></span>
                                    <span class="aon-test2-plus">+</span>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 2 -->
                        <div class="item">
                            <div class="aon-test2-item">
                                <div class="aon-test2-pic"><img src="{{asset('frontEnd/images/testimonials2/pic2.jpg')}}" alt=""/></div>
                                <h3 class="aon-test2-name">David Smith</h3>
                                <div class="aon-test2-position">Web Designer</div>
                                <div class="aon-test2-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore.</div>
                                <div class="aon-test2-animate">
                                    <span class="aon-test2-circle1"></span>
                                    <span class="aon-test2-square1"></span>
                                    <span class="aon-test2-square2"></span>
                                    <span class="aon-test2-circle2"></span>
                                    <span class="aon-test2-plus">+</span>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 3 -->
                        <div class="item">
                            <div class="aon-test2-item">
                                <div class="aon-test2-pic"><img src="{{asset('frontEnd/images/testimonials2/pic3.jpg')}}" alt=""/></div>
                                <h3 class="aon-test2-name">David Smith</h3>
                                <div class="aon-test2-position">Web Designer</div>
                                <div class="aon-test2-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore.</div>
                                <div class="aon-test2-animate">
                                    <span class="aon-test2-circle1"></span>
                                    <span class="aon-test2-square1"></span>
                                    <span class="aon-test2-square2"></span>
                                    <span class="aon-test2-circle2"></span>
                                    <span class="aon-test2-plus">+</span>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 4 -->
                        <div class="item">
                            <div class="aon-test2-item">
                                <div class="aon-test2-pic"><img src="{{asset('frontEnd/images/testimonials2/pic1.jpg')}}" alt=""/></div>
                                <h3 class="aon-test2-name">David Smith</h3>
                                <div class="aon-test2-position">Web Designer</div>
                                <div class="aon-test2-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore.</div>
                                <div class="aon-test2-animate">
                                    <span class="aon-test2-circle1"></span>
                                    <span class="aon-test2-square1"></span>
                                    <span class="aon-test2-square2"></span>
                                    <span class="aon-test2-circle2"></span>
                                    <span class="aon-test2-plus">+</span>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
                
            </div>
        </section>
        <!-- Services Finder categories END -->            

        <!-- Statics -->
        <section class="aon-statics-area2">
            <div class="container">

                <div class="aon-statics-area2-section">
                    <div class="aon-statics-area2-bg">
                        <!--Title Section Start-->
                        <div class="section-head aon-title-center white">
                            <span class="aon-sub-title">Statics</span>
                            <h2 class="sf-title">Trusted by thousands of people all over the world</h2>
                        </div>
                            
                        <div class="section-content">
                            <div class="aon-statics-blocks2">
                                <div class="row">

                                    <!-- COLUMNS 1 -->
                                    <div class="col-lg-3 col-md-6 col-6">
                                        <div class="aon-static-section2 aon-t-white2">
                                            <div class="aon-company-static-num2 counter">36</div>
                                            <div class="aon-company-static-name2">Providers</div>
                                        </div>
                                    </div>

                                    <!-- COLUMNS 2 -->
                                    <div class="col-lg-3 col-md-6 col-6">
                                        <div class="aon-static-section2 aon-t-skyblue2">
                                            <div class="aon-company-static-num2 counter">{{count($Categories)}}</div>
                                            <div class="aon-company-static-name2">Categories</div>
                                        </div>
                                    </div>

                                    <!-- COLUMNS 3 -->
                                    <div class="col-lg-3 col-md-6 col-6">
                                        <div class="aon-static-section2 aon-t-yellow2">
                                            <div class="aon-company-static-num2 counter">108</div>
                                            <div class="aon-company-static-name2">Jobs</div>
                                        </div>
                                    </div>

                                    <!-- COLUMNS 4 -->
                                    <div class="col-lg-3 col-md-6 col-6">
                                        <div class="aon-static-section2 aon-t-green2">
                                            <div class="aon-company-static-num2 counter">89</div>
                                            <div class="aon-company-static-name2">Customer</div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <!-- Statics END -->

        <!--Newsletter Start-->
        <section class="aon-newsletter-area2">
            <div class="container">

                <div class="aon-newsletter-area2-section">
                    <h3 class="aon-title">We empower clients to grow their businesses based on the effective use of technology</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. lorem Ipsum has been the standard dummy text ever since the 1500s, when.</p>
                    <form class="aon-nl-width">
                        <div class="form-group sf-news-l-form">
                            <input type="text" class="form-control" placeholder="Enter Your Email">
                            <button type="submit" class="sf-sb-btn">Submit</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </section>
        <!--Newsletter Start-->

    </div>
    <!-- CONTENT END -->
    {{-- <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
              <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
      
        </div>
      </div> --}}
      <div class="modal fade" id="QuestionModel" >
        <div class="modal-dialog" style="margin-top:10px">
          <div class="modal-content">
              
              <div class="modal-header">
                <h4 class="modal-title" id = "CategoryName">Modal </h4>
                <button type="button" class="close"  onclick = "closeModelPopup()" >&times;</button>
                {{--  --}}
              </div>
              <div class="modal-body">
                  <div class="sf-custom-tabs sf-custom-new aon-logon-sign-area p-3">
                    <div id="Upcoming">
                        <div class="sf-tabs-content">
                            <form id="multiStepForm" method="POST" action="{{route('addLead')}}">
                                @csrf
                                <input type="hidden" name="category_id" id="category_id" value ="">
                                <div id = "stepsList">
                                    {{-- <div class="checkbox sf-radio-checkbox">
                                        <label >
                                            <input id="td2_2" name="abc" value="five" type="checkbox" >
                                            <label for="td2_2">Keep me logged Keep me logged Keep me logged Keep me logged</label>
                                        </label>
                                    </div> --}}
                                  

                                </div>
                              </form>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
@endsection
@section('extraScripts')

<script  src="{{ asset('frontEnd/js/source.js')}}"></script>
<script src="{{ asset('frontEnd/js/chosen.jquery.js')}}"></script>


<script>
   
    var url = "{{route('getQuestions')}}";
    var currentStep = 1;

    function QuestionsModel(categoryId,categoryName){  
        currentStep = 1;
        getQuestions(categoryId);
        $('#QuestionModel').modal({backdrop: 'static',keyboard: true, show: true}); 
        $("#category_id").val(categoryId);
        $("#CategoryName").text(categoryName);
    }

    function prevQuestion(step){
        $(".step").hide();
        $(".step[data-step='" + step + "']").show();
        $(".step[data-step='" + (step+1) + "']").remove();
    }

    function updateStep() {
      $(".step").hide();
      $(".step[data-step='" + currentStep + "']").show();
    }

    function getQuestions(categoryId=null ,questionId = null,step =1){
   
        $.ajax({
            type: 'get',
            url: url,
            data: {
            'categoryId' : categoryId,
            'questionId' : questionId,
            },
            beforeSend: function () { 
            //need to show loader
                },
            success: function (response) {
                htmlMaker(response,categoryId,categoryId);
            },
            complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                // $("#serachpnrfromsubmit").prop('disabled',false);
                // $("#serachpnrfromsubmit").find('span').html( '' );
                
                },
            error:function(response){
            $("#appliedCouponCode").val(couponCode);
            $html = `<div class="alert alert-danger">
                            <strong>Error!</strong> `+response.error+`
                        </div>`;
                $("#couponResponse").html($html);
                $("#couponCodeAmount").text(response.CouponAmount);
                $("#totalamount").text(response.AfterApplyingCouponTotalAmount);
                $("#standedamount").text(response.AfterApplyingCouponStandedAmount);
            }
        });

    }

    function htmlMaker(response,categoryId,questionId,isStatic = "no"){
        var toAppend = true;

        currentStep = $(".step[data-step]").length;
        toAppend = false;

        if(isStatic == "no"){
            if(response.data.length == 0){
                html = `<h4>No Questions Found</h4>`;
                toAppend = false;
            }else{
                toAppend = true;

                html = `<div class="step" data-step="`+currentStep+`" >
                            <h3 style="padding-bottom: 10px;">`+response.data.question_text+`</h3>`;
                if(response.data.type == 'input'){
                    html += `<div id ="error`+currentStep+`" style="display: none;color: red;" class="alert alert-danger">Please enter the answer</div>
                    <div class="form-group">
                        <input type="text" class="form-control QuestionStep`+currentStep+`"  name="`+response.data.slug+`" required>
                    </div>`;
                }else if(response.data.type == 'date'){
                    html += `<div id ="error`+currentStep+`" style="display: none;color: red;" class="alert alert-danger">Please select the date</div>
                    <div class="form-group">
                        <input type="date" class="form-control QuestionStep`+currentStep+`"  name="`+response.data.slug+`">
                    </div>`;
                }else if(response.data.type == 'normalRadio'){
                    html += `<div id ="error`+currentStep+`" style="display: none;color: red;" class="alert alert-danger">Please select an option</div>
                    <div class="form-group">
                        <div class="aon-inputicon-box"> 
                            <div class="radio-box">`
                        response.data.options.forEach(option => {
                        html += `<div class="checkbox sf-radio-checkbox">
                                    <input id="loc`+option.id+`" name="`+response.data.slug+`" value="`+option.id+`" type="radio" class = "QuestionStep`+currentStep+`" data-nextQuestionId = "`+option.next_question_id+`">
                                    <label for="loc`+option.id+`">`+option.option_text+`</label>
                                </div>`
                    }); 
                    // if(response.data.show_other_option == 1){
                    //     html +=`<div class="checkbox sf-radio-checkbox">
                    //                 <input id="locOther`+response.data.id+`" name="`+response.data.slug+`" value="other" type="radio" class = "QuestionStep`+currentStep+`" data-nextQuestionId = "">
                    //                 <label for="locOther`+response.data.id+`"><input type = "text" placeholder ="Other" name=""></label>
                    //             </div>`;
                    // }
                    html +=  `</div>
                            </div>
                        </div>`;
                }else if(response.data.type == 'imageRadio'){
                    html += `<div id ="error`+currentStep+`" style="display: none;color: red;" class="alert alert-danger">Please select an option</div>
                    <div class="form-group"> 
                        <div class="row">`
                    response.data.options.forEach(option => {
                        image = "{{asset('uploads/questions/options')}}"+"/"+option.image
                        html += `<div class="col-md-6 pb-3">
                                    <div class="custom-control custom-radio image-checkbox card" style="border-radius: 5%;">
                                        <input type="radio" class="custom-control-input QuestionStep`+currentStep+`" id="ck`+option.id+`" name="`+response.data.slug+`" value = "`+option.id+`" data-nextQuestionId = "`+option.next_question_id+`">
                                        <label class="custom-control-label" for="ck`+option.id+`">
                                            <img src="`+image+`" alt="#" class="img-fluid" style="border-radius: 5% 5% 0% 0%;">
                                                <div style="text-align: center;"> `+option.option_text+` </div>
                                        </label>
                                    </div>
                                </div> `;
                    }); 
                    
                    html +=  `</div>
                        </div>`;
                }

                // else if(response.data.type == 'multiSelect'){

                //     html += `<div class="form-group"> 
                //         <div class="row">
                //             <select data-placeholder="Choose a Country..." class="mselect QuestionStep`+currentStep+`" name ="`+response.data.slug+`" multiple style="width: 200px">`
                //     response.data.options.forEach(option => {
                //         html += `<option value="`+option.id+`">`+option.option_text+`</option>`;
                //     }); 
                //     html +=  `
                //                 </select>
                //                 </div>
                //             </div>`;
                // }
                else if(response.data.type == 'multiSelect'){
                html += `<div id ="error`+currentStep+`" style="display: none;color: red;" class="alert alert-danger">Please select an option</div>
                <div class="form-group">` 
                    response.data.options.forEach(option => {
                        html += `<div class="checkbox sf-radio-checkbox">
                            <label >
                                <input id="td2_`+option.id+`" name="`+response.data.slug+`[]" value="`+option.id+`" type="checkbox" class ="QuestionStep`+currentStep+`">
                                <label for="td2_`+option.id+`">`+option.option_text+`</label>
                            </label>
                        </div>`
                    });
                    html += `</div>`;
                }
                html += `<div style="float:right">`
                if(currentStep != 0){
                    html += `<button type="button"  class="site-button" onclick = "prevQuestion(`+(currentStep-1)+`)" style="margin-right: 10px;">Prev </button>`
                }
                html += `<button type="button"  class="site-button" onclick = "nextQuestion('`+response.data.type+`',`+response.data.next_question_id+`)" >Next </button>
                            </div>   
                        </div>`;
            }
        }else{
            toAppend = true;
            html = `<div class="step" data-step="`+currentStep+`" >
                        <h3>Email </h3>   
                        <div class="form-group">
                            <input type="email" class="form-control QuestionStep`+currentStep+`"  name="email" required>
                        </div>
                        <h3>Phone </h3>
                        <div class="form-group">
                            <input type="text" class="form-control QuestionStep`+currentStep+`"  name="phone" required>
                        </div>
                        <div style="float:right">
                            <button type="button"  class="site-button" onclick = "prevQuestion(`+(currentStep-1)+`)" style="margin-right: 10px;">Prev </button>
                            <button type="submit"  class="site-button"  >Submit </button>
                        </div>
                    </div>`;
        }

        if(toAppend == false){
            $("#stepsList").html(html);
        }else{
            $("#stepsList").append(html);
        }
        if(isStatic =="no" && response.data.type == 'multiSelect'){
            $(".mselect").chosen({width: "100%" ,"padding":"16px"}); 
        }
        updateStep();
    }


    function nextQuestion(formtype,questionId){
        validateStep = ($(".step[data-step]").length - 1);
    
        var isvalid = false;
        isvalid = validateAnswer(formtype , validateStep);
        if(isvalid){
            if(questionId == null){
                htmlMaker(null,null,null,'yes');
            }else{
                if(formtype == "imageRadio" || formtype == "normalRadio"){
                    optionNext =  $(".QuestionStep"+validateStep+":checked").data("nextquestionid");
                    if(!(optionNext == '' || optionNext == null || optionNext == undefined )){
                        questionId = optionNext;
                    }
                }
                getQuestions(null,questionId);
            }
        }   
    }
    
    function validateAnswer(formtype ,validateStep){
        if(formtype == "input" || formtype == "date" || formtype == "imageRadio" || formtype == "normalRadio" || formtype == "multiSelect"){
            if(formtype == "input" || formtype == "date"){
                value = $(".QuestionStep"+validateStep).val();
            }else if(formtype == "imageRadio"  || formtype == "normalRadio"){
                value =  $(".QuestionStep"+validateStep+":checked").val();
            }else if(formtype == "multiSelect"){
                value =  $('.QuestionStep'+validateStep).is(':checked');
            }
            if(value == '' || value == undefined || value == false){
                console.log("dd",value);
                $("#error"+validateStep).css("display","block");
                return false;
            }else{
                $("#error"+validateStep).css("display","none");
            }
        }
        return true;
    }

    function closeModelPopup(){
        categoryName = $("#CategoryName").text();
        text = 'Are you sure you want to close the '+categoryName+ ' category ?';
        confirmMessage = confirm(text);
        if(confirmMessage){
            $(".step").remove();
            $('#QuestionModel').modal('toggle'); 
        }
    }

</script>
<script src="{{ asset('admin-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script>
    $(document).ready(function () {
        var planType = 'monthly';
        $("#planType").change(function() {
            if ($(this).is(":checked")) {
                //yearly
                $(".PlanAmountmonthly").css("display" , "none");
                $(".PlanAmountyearly").css("display" , "block");
            } else {
                $(".PlanAmountmonthly").css("display" , "block");
                $(".PlanAmountyearly").css("display" , "none");
            }
        });
        $(".pricing").click(function() {
            activeTab = $(this);
            $(".pricing").removeClass("sf-pricing-active");
            activeTab.addClass("sf-pricing-active");
            
            // Do something when the button is clicked
        });




            
    });


    // planUrl = '{{route("getPlans")}}';
    // function Planning(planType){
    //     $.ajax({
    //         type: 'get',
    //         url: planUrl,
    //         data: {
    //         'planType' : planType
    //         },
    //         beforeSend: function () { 
    //         //need to show loader
    //             },
    //         success: function (response) {
    //            console.log(response);
    //         },
    //         complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
    //             // $("#serachpnrfromsubmit").prop('disabled',false);
    //             // $("#serachpnrfromsubmit").find('span').html( '' );
    //             },
    //         error:function(response){
    //             console.log(response);
    //         }
    //     });
    // } 
</script>

@if(session('success'))

    <script>
        success = "{{session('success')}}"
        $(document).ready(function () {
        
            Swal.fire({
                title: "Success",
                text: success,
                type: "success",
                confirmButtonClass: 'site-button',
                buttonsStyling: false,
            });
        });
    </script>
@endif
@if(session('error'))

<script>
    error = "{{session('error')}}"
    $(document).ready(function () {
        Swal.fire({
            title: "Error!",
            text: error,
            type: "error",
            confirmButtonClass: 'site-button',
            buttonsStyling: false,
        });
    });
</script>
@endif
@endsection