@extends('front_end.layouts.master')
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
                        <!-- COLUMNS 1 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="media-bg-animate mba-bdr-15">
                                <div class="aon-categories-area2-iconbox aon-icon-effect">
                                    <div class="aon-cate-area2-icon">
                                        <span>
                                            <i class="aon-icon"><img src="{{asset('frontEnd/images/popular-categories-icon/1.png')}}" alt=""></i>
                                        </span>
                                    </div>
                                    <div class="aon-cate-area2-content">
                                        <h4 class="aon-tilte"><a href="categories-detail.html">Car Service</a></h4>
                                        <p>124 Listing</p>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <!-- COLUMNS 2 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="media-bg-animate mba-bdr-15">
                                <div class="aon-categories-area2-iconbox aon-icon-effect">
                                    <div class="aon-cate-area2-icon">
                                        <span> 
                                            <i class="aon-icon"><img src="{{asset('frontEnd/images/popular-categories-icon/2.png')}}" alt=""></i>
                                        </span>
                                    </div>
                                    <div class="aon-cate-area2-content">
                                        <h4 class="aon-tilte"><a href="categories-detail.html">Salon Services</a></h4>
                                        <p>132 Listing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 3 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="media-bg-animate mba-bdr-15">
                                <div class="aon-categories-area2-iconbox aon-icon-effect">
                                    <div class="aon-cate-area2-icon">
                                        <span>
                                            <i class="aon-icon"><img src="{{asset('frontEnd/images/popular-categories-icon/3.png')}}" alt=""></i>
                                        </span>
                                    </div>
                                    <div class="aon-cate-area2-content">
                                        <h4 class="aon-tilte"><a href="categories-detail.html">Plumber</a></h4>
                                        <p>124 Listing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 4 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="media-bg-animate">
                                <div class="aon-categories-area2-iconbox aon-icon-effect">
                                    <div class="aon-cate-area2-icon">
                                        <span>
                                            <i class="aon-icon"><img src="{{asset('frontEnd/images/popular-categories-icon/4.png')}}" alt=""></i>
                                        </span>
                                    </div>
                                    <div class="aon-cate-area2-content">
                                        <h4 class="aon-tilte"><a href="categories-detail.html">Electrician</a></h4>
                                        <p>128 Listing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 5 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="media-bg-animate mba-bdr-15">
                                <div class="aon-categories-area2-iconbox aon-icon-effect">
                                    <div class="aon-cate-area2-icon">
                                        <span>
                                            <i class="aon-icon"><img src="{{asset('frontEnd/images/popular-categories-icon/5.png')}}" alt=""></i>
                                        </span>
                                    </div>
                                    <div class="aon-cate-area2-content">
                                        <h4 class="aon-tilte"><a href="categories-detail.html">Yoga Classes</a></h4>
                                        <p>145 Listing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 6 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="media-bg-animate">
                                <div class="aon-categories-area2-iconbox aon-icon-effect">
                                    <div class="aon-cate-area2-icon">
                                        <span>
                                            <i class="aon-icon"><img src="{{asset('frontEnd/images/popular-categories-icon/6.png')}}" alt=""></i>
                                        </span>
                                    </div>
                                    <div class="aon-cate-area2-content">
                                        <h4 class="aon-tilte"><a href="categories-detail.html">House Ceaning</a></h4>
                                        <p>165 Listing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 7 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="media-bg-animate mba-bdr-15">
                                <div class="aon-categories-area2-iconbox aon-icon-effect">
                                    <div class="aon-cate-area2-icon">
                                        <span>
                                            <i class="aon-icon"><img src="{{asset('frontEnd/images/popular-categories-icon/7.png')}}" alt=""></i>
                                        </span>
                                    </div>
                                    <div class="aon-cate-area2-content">
                                        <h4 class="aon-tilte"><a href="categories-detail.html">Gym Classes</a></h4>
                                        <p>156 Listing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 8 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="media-bg-animate mba-bdr-15">
                                <div class="aon-categories-area2-iconbox aon-icon-effect">
                                    <div class="aon-cate-area2-icon">
                                        <span>
                                            <i class="aon-icon"><img src="{{asset('frontEnd/images/popular-categories-icon/8.png')}}" alt=""></i>
                                        </span>
                                    </div>
                                    <div class="aon-cate-area2-content">
                                        <h4 class="aon-tilte"><a href="categories-detail.html">Transport</a></h4>
                                        <p>149 Listing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- COLUMNS 9 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="media-bg-animate mba-bdr-15">
                                <div class="aon-categories-area2-iconbox aon-icon-effect">
                                    <div class="aon-cate-area2-icon">
                                        <span>
                                            <i class="aon-icon"><img src="{{asset('frontEnd/images/popular-categories-icon/9.png')}}" alt=""></i>
                                        </span>
                                    </div>
                                    <div class="aon-cate-area2-content">
                                        <h4 class="aon-tilte"><a href="categories-detail.html">AC Repair</a></h4>
                                        <p>175 Listing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="aon-btn-pos-center">
                        <a class="site-button" href="all-categories.html">View All</a>
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
            
            <div class="section-content">
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
            </div>

        </div>
    </div>
    <!-- Recently Posted Jobs Section END -->


    <!-- Pricing Plan -->
    <div class="section-full aon-pricing-area2">
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
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                    <span>Bill Yearly</span>
                </div>
                <div class="sf-pricing-section-outer">
                    <div class="row no-gutter">
                        <!-- COLUMNS 1 -->
                        <div class="col-md-3">
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
                        </div>
                        <!-- COLUMNS 2 -->
                        <div class="col-md-3">
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
                        </div>
                        <!-- COLUMNS 3 -->
                        <div class="col-md-3">
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
                        </div>
                        <!-- COLUMNS 4 -->
                        <div class="col-md-3">
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
                        </div>
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
                                        <div class="aon-company-static-num2 counter">59</div>
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
@endsection