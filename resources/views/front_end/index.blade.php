@extends('front_end.layouts.master')
@section('extrastyle')
    <link rel="stylesheet" href="{{ asset('frontEnd/css/image-radio-master/bootstrap-image-checkbox.css')}}">
    <link rel="stylesheet" href="{{ asset('frontEnd/css/chosen.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <style>
        #QuestionModel .modal-dialog{
            margin-top: 60px !important;
        }
        </style>
@endsection
@section('content')
    <!-- CONTENT START -->
    <div class="page-content">
        
        
        <!-- BANNER SECTION START -->
        <section class="">
            <!--banner 2-->
            <div class="container">
                <div class="aone-banner-area2-inner">
                    <div class="row d-flex align-items-center">
                        <!--Banner Left-->
                        <div class="col-lg-5 col-md-12">
                            <div class="aon-bnr2-content-wrap">
                                <!--Banner Text-->
                                <div class="aon-bnr-write">
                                    <h2 class="text-top-line">{{__('lang.hire')}}
                                        <span class="text-secondry">{{__('lang.experts')}}</span> &amp; 
                                    </h2>
                                    <h2 class="text-bot-line">{{__('lang.get_your_job_done')}}</h2>
                                </div>
                                <!--Banner Text End-->
                                <!--Seach Bar-->
                                <div class="aon-bnr2-search-bar">
                                    <form>
                                        <div class="aon-bnr2-search-box">
                                            
                                            <!-- COLUMNS 1 -->
                                            <div class="aon-search-input category-select ">
                                                <select id="categorysrh" name="catid" class="form-control sf-form-control aon-categories-select sf-select-box" title="Service">
                                                    <option class="bs-title-option" value="">{{__('lang.select_a_service')}}</option>
                                                    @foreach ($Services as $service)
                                                        {{$icon = asset('uploads/services/icons/'.$service->icon)}}
                                                        <option value="{{$service->id}}" id = "servicedata{{$service->id}}" data-servicename = "{{$service->name}}" data-content="<img class='childcat-img' width='50' height='auto' style='border-radius: 5px !important' src={{$icon}}><span class='childcat'>{{ucfirst($service->name)}}</span>">{{ucfirst($service->name)}}</option>
                                                    @endforeach                                        
                                                </select>
                                            </div>
                                            <!-- COLUMNS 2 -->
                                            {{-- <div class="aon-inputicon-box keywords-input">
                                                <input type="text" placeholder="Pincode" class="form-control">
                                                <i class="aon-input-icon fa fa-map-marker"></i>
                                            </div> --}}
                                            <div class="aon-inputicon-box aon-search-input keywords-input">
                                                <input type="number" placeholder="Pincode" class="form-control" id = "servicePinCode">
                                                <i class="aon-input-icon fa fa-map-marker"></i>
                                            </div>
                                            <!-- COLUMNS 3 -->
                                            <div class="aon-search-btn-wrap">
                                                <button class="aon-search-btn" type="button" onclick="servicepopup()">{{__('lang.search')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="text-danger" style="display: none" id="serviceError">* {{__('lang.please_select_a_service')}} </div>
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
                            <span class="aon-sub-title">{{__('lang.services')}}</span>
                            <h2 class="sf-title">{{__('lang.popular_services')}}</h2>
                        </div>
                        <!-- COLUMNS RIGHT -->
                        {{-- <div class="col-lg-6 col-md-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div> --}}
                    </div>
                </div>
                <!--Title Section End-->
                    
                <div class="section-content">
                    <div class="aon-categories-area2-section">
                        <div class="row justify-content-center">
                            @foreach ($Services as $item)
                            <div class="col-lg-4 col-md-6" >
                                <div class="media-bg-animate mba-bdr-15" >
                                    <div class="aon-categories-area2-iconbox aon-icon-effect" onclick="QuestionsModel({{$item->id}} ,'{{$item->name}}')">
                                        <div class="aon-cate-area2-icon">
                                            <span>
                                                <i class="aon-icon"><img src="{{asset('uploads/services/icons/'.$item->icon)}}" alt=""></i>
                                            </span>
                                        </div>
                                        <div class="aon-cate-area2-content">
                                            {{-- <h4 class="aon-tilte"><a href="{{route('serviceDetails',['slug'=>$item->slug])}}">{{$item->name}}</a></h4> --}}
                                            <h4 class="aon-tilte">{{ucfirst($item->name)}}</h4>
                                            <p>{{$item->leadCount}} {{__('lang.listing')}}</p>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                                
                            @endforeach
                            
                        </div>
                        <div class="aon-btn-pos-center">
                            <a class="site-button" href="{{route('service')}}">{{__('lang.view_all')}}</a>
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
                            <span class="aon-sub-title">{{__('lang.steps')}}</span>
                            <h2 class="sf-title">{{__('lang.how_it_work')}}</h2>
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
                                                <h4 class="aon-tilte">{{__('lang.describe_your_task')}}</h4>
                                                <p>{{__('lang.this_helps_us_determine_which_Taskers_We_are_abest_jobs')}}</p>
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
                                                <h4 class="aon-tilte">{{__('lang.choose_a_tasker')}}</</h4>
                                                <p>{{__('lang.this_helps_us_determine_which_Taskers_We_are_abest_jobs')}}</p>
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
                                                <h4 class="aon-tilte">{{__('lang.live_smarter')}}</h4>
                                                <p>{{__('lang.this_helps_us_determine_which_Taskers_We_are_abest_jobs')}}</p>
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
                            <span class="aon-sub-title">{{__('lang.vendor')}}</span>
                            <h2 class="sf-title">{{__('lang.featured_vendors')}}</h2>
                        </div>
                        {{-- <div class="col-lg-6 col-md-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div> --}}
                    </div>
                </div>
                <!--Title Section Start-->
                <div class="section-content">
                    <div class="owl-carousel aon-vendor-provider-two-carousel aon-owl-arrow">

                        @foreach($Vendors as $vendor)
                        <?php //dd();?>
                        <div class="item">
                            <div class="aon-ow-provider-wrap2">
                                <div class="aon-ow-provider2 shine-hover">

                                    <div class="aon-ow-top">
                                        <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="aon-ow-info">
                                            <h4 class="sf-title"><a href="{{route('vendor.details' , ['id' =>encrypt($vendor->id)])}}">{{$vendor->name}}</a></h4>
                                            <span>{{$vendor->vendorDetails->company_name??''}}</span>
                                        </div>
                                    </div>
                                    <div class="aon-ow-mid">
                                        <div class="aon-ow-media media-bg-animate">
                                            @if(!empty($vendor->vendorDetails->company_logo))
                                                <a class="shine-box" href="{{route('vendor.details' , ['id' =>encrypt($vendor->id)])}}"><img src="{{asset('uploads/company/'.$vendor->vendorDetails->company_logo)}}" alt=""></a>
                                            @else
                                                <?php //dd($noImage)?>
                                                <a class="shine-box" href="{{route('vendor.details' , ['id' =>encrypt($vendor->id)])}}"><img src="{{asset('frontEnd/images/default-vendor-image.png')}}" alt=""></a>
                                            @endif
                                          
                                        </div>
                                        <p>{{$vendor->description}}</p>
                                        <div class="aon-ow-pro-rating">
                                            @if(!empty($vendor->reviews_sum_rating))
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $vendor->reviews_sum_rating)
                                                        <span class="fa fa-star"></span>
                                                    @else
                                                        <span class="fa fa-star text-gray"></span>
                                                    @endif
                                                @endfor
                                            @else
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                            @endif
                                         
                                        </div>
                                        <div class="aon-ow-bottom">
                                            <a href="{{route('vendor.details' , ['id' =>encrypt($vendor->id)])}}" class="site-button">Details</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach

                       
                        
                     

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
        {{-- <div class="section-full aon-postjobs-area2">
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
            </div>
        </div> --}}
        <!-- Recently Posted Jobs Section END -->


        <!-- Pricing Plan -->
        {{-- <div class="section-full aon-pricing-area2" id= "pricing">
            <div class="container">
        
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
                        </div>
                    </div>
                </div>

            </div>
        </div> --}}
        <!-- Pricing Plan END --> 

        <!-- Latest Blog -->
        <div class="section-full aon-latest-blog-area2">
            <div class="container">
                <!--Title Section Start-->
                <div class="section-head">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <span class="aon-sub-title">{{__('lang.blog')}}</span>
                            <h2 class="sf-title">{{__('lang.latest_blogs')}}</h2>
                        </div>
                        {{-- <div class="col-lg-6 col-md-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div> --}}
                    </div>
                </div>

                <div class="section-content">
                    <div class="aon-l-blog-area2-section">
                        <div class="row d-flex justify-content-center">
                            @foreach($Blogs as $blog )
                            <div class="col-lg-4 col-md-6 shine-hover">
                                <div class="aon-blog-style-1 media-bg-animate mba-bdr-20">
                                    <div class="post-bx">
                                        <!-- Content section for blogs start -->
                                        <div class="post-thum shine-box"> 
                                            <img title="title" alt="" src="{{asset('uploads/blogs/')."/".$blog->image}}">
                                        </div>
                                        <div class="post-info">
                                            <div class="post-categories"><a href="{{route('blogDetails',['slug' => $blog->slug])}}">{{$blog->service->name}}</a></div>
                                            <div class="post-meta">
                                            <ul>
                                                <li class="post-date"><span>{{ Carbon\Carbon::parse($blog->created_at)->format('d M H:i') }}</span></li>
                                                <li class="post-author">By
                                                <a href="{{route('blogDetails',['slug' => $blog->slug])}}" title="Posts by {{$blog->user_name}}" rel="author">{{$blog->user_name}}</a>
                                                </li>
                                                
                                            </ul>
                                            </div>
                                                                                
                                            <div class="post-text">
                                            <h4 class="post-title">
                                                <a href="{{route('blogDetails',['slug' => $blog->slug])}}">{{ $blog->name}}</a>
                                            </h4>
                                            </div>
                                            
                                        </div>
                                        <!-- Content section for blogs end -->
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="aon-btn-pos-center">
                            <a class="site-button" href="{{route('blogs')}}">{{__('lang.view_all')}}</a>
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
                            <span class="aon-sub-title">{{__('lang.testimonials')}}</span>
                            <h2 class="aon-title">{{__('lang.what_people_say')}}</h2>
                        </div>
                        {{-- <div class="col-lg-6 col-md-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do usmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div> --}}
                    </div>
                </div>
                    
                <div class="section-content">
                    <div class="owl-carousel testimonials-two-carousel-owl aon-owl-arrow">
                        @forEach($Testimonials as $testimonial)
                        <!-- COLUMNS 1 -->
                        <div class="item">
                            <div class="aon-test2-item">
                                <div class="aon-test2-pic"><img src="{{asset('uploads/testimonials/'.$testimonial->image)}}" alt=""/></div>
                                <h3 class="aon-test2-name">{{$testimonial->name}}</h3>
                                <div class="aon-test2-position">{{$testimonial->service->name}}</div>
                                <div class="aon-test2-text">{{$testimonial->description}}</div>
                                <div class="aon-test2-animate">
                                    <span class="aon-test2-circle1"></span>
                                    <span class="aon-test2-square1"></span>
                                    <span class="aon-test2-square2"></span>
                                    <span class="aon-test2-circle2"></span>
                                    <span class="aon-test2-plus">+</span>
                                </div>
                            </div>
                        </div>
                        @endforeach              
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
                            <span class="aon-sub-title">{{__('lang.statics')}}</span>
                            <h2 class="sf-title">{{__('lang.trusted_by_thousands_of_people_all_over_the_india')}}</h2>
                        </div>
                            
                        <div class="section-content">
                            <div class="aon-statics-blocks2">
                                <div class="row">

                                    <!-- COLUMNS 1 -->
                                    <div class="col-lg-3 col-md-6 col-6">
                                        <div class="aon-static-section2 aon-t-white2">
                                            <div class="aon-company-static-num2 counter">{{$staticsData['vendors']}}</div>
                                            <div class="aon-company-static-name2">{{__('lang.vendors')}}</div>
                                        </div>
                                    </div>

                                    <!-- COLUMNS 2 -->
                                    <div class="col-lg-3 col-md-6 col-6">
                                        <div class="aon-static-section2 aon-t-skyblue2">
                                            <div class="aon-company-static-num2 counter">{{$staticsData['services']}},</div>
                                            <div class="aon-company-static-name2">{{__('lang.services')}}</div>
                                        </div>
                                    </div>

                                    <!-- COLUMNS 3 -->
                                    <div class="col-lg-3 col-md-6 col-6">
                                        <div class="aon-static-section2 aon-t-yellow2">
                                            <div class="aon-company-static-num2 counter">{{$staticsData['leads']}}</div>
                                            <div class="aon-company-static-name2">{{__('lang.leads')}}</div>
                                        </div>
                                    </div>

                                    <!-- COLUMNS 4 -->
                                    <div class="col-lg-3 col-md-6 col-6">
                                        <div class="aon-static-section2 aon-t-green2">
                                            <div class="aon-company-static-num2 counter">{{$staticsData['blogs']}}</div>
                                            <div class="aon-company-static-name2">{{__('lang.blogs')}}</div>
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
        <div class="modal-dialog modal-lg" >
          <div class="modal-content">
              
              <div class="modal-header">
                <h4 class="modal-title" id = "ServiceName"> </h4>
                <button type="button" class="close"  onclick = "closeModelPopup()" >&times;</button>
                {{--  --}}
              </div>
              <div class="modal-body">
                  <div class="sf-custom-tabs sf-custom-new aon-logon-sign-area p-3">
                    <div id="Upcoming">
                        <div class="sf-tabs-content">
                            <form id="multiStepForm" method="POST" action="{{route('addLead')}}">
                                @csrf
                                <input type="hidden" name="service_id" id="service_id" value ="">
                                <div id = "stepsList">
                          
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
<script src="{{ asset('admin-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>


<script>
   
    var url = "{{route('getQuestions')}}";
    var currentStep = 1;

    function QuestionsModel(serviceId,serviceName){  
        currentStep = 1;
        getQuestions(serviceId);
        $("#stepsList").html("");
        $('#QuestionModel').modal({backdrop: 'static',keyboard: true, show: true}); 
        $("#service_id").val(serviceId);
        $("#ServiceName").text(serviceName);
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

    function getQuestions(serviceId=null ,questionId = null,step =1){
        console.log(serviceId,questionId,step);
        $.ajax({
            type: 'get',
            url: url,
            data: {
            'serviceId' : serviceId,
            'questionId' : questionId,
            },
            beforeSend: function () { 
            //need to show loader
                },
            success: function (response) {
                htmlMaker(response,serviceId,serviceId);
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

    function htmlMaker(response,serviceId,questionId,isStatic = "no"){
        var toAppend = true;

        currentStep = $(".step[data-step]").length;
        toAppend = false;
        pinCode = $("#servicePinCode").val();

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
                    html += `<button type="button"  class="site-button" onclick = "prevQuestion(`+(currentStep-1)+`)" style="margin-right: 10px;">Back </button>`
                }
                html += `<button type="button"  class="site-button" onclick = "nextQuestion('`+response.data.type+`',`+response.data.next_question_id+`)" >Next </button>
                            </div>   
                        </div>`;
            }
        }else{
            toAppend = true;
            html = `<div class="step" data-step="`+currentStep+`" >
                        <h5>Email </h5>   
                        <div class="form-group">
                            <input type="email" class="form-control QuestionStep`+currentStep+`"  name="email" required>
                        </div>
                        <h5>Phone </h5>
                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="text" class="form-control QuestionStep`+currentStep+`" name="phone" required id = 'phoneNumber'>
                                    <div id="mobileVerification" style="display: block;color: red;" class="">(Please Verify Your Number)</div>
                                    <div id ="ErrorphoneNumber" style="display: none;color: red;" class=""></div>
                                    <input type="hidden" name="serverOtp" id = 'serverOtp'>
                                </div>
                            </div>
                            <div>
                                <button class="site-button" type= "button" onclick = "verifyPhoneNumber()" id = "otpButton"> Send OTP </button>
                            </div>
                        </div>
                        <div style = "display: none;" id = "otpDiv">
                            <h5>Verify OTP </h5>
                            <div class="row">
                                <div class="col-9">
                                    <div class="form-group">
                                        <input type="number" class="form-control QuestionStep`+currentStep+`" name="otp" required id = 'otp'>
                                        <div id ="ErrorphoneNumber" style="display: none;color: red;" class="alert alert-danger"></div>
                                    </div>
                                </div>
                                <div>
                                    <button class="site-button" type= "button" onclick = "verifyOtp()" > Verify </button>
                                </div>
                            </div>
                        </div>
                       
                        <div class ="row">
                            <div class ="col-6">
                                <h5>Name </h5>
                                <div class="form-group">
                                    <input type="text" class="form-control QuestionStep`+currentStep+`"  name="name" required>
                                </div>
                            </div>
                            <div class ="col-6">
                                <h5>PinCode </h5>
                                <div class="form-group">
                                    <input type="number" class="form-control QuestionStep`+currentStep+`"  name="pin_code" value="`+pinCode+`" required>
                                </div>
                            </div>
                        </div>
                        <h5>Address </h5>
                        <div class="form-group">
                            <textarea class="form-control QuestionStep`+currentStep+`" name="address" rows="2" required></textarea>
                        </div>
                        <div style="float:right">
                            <button type="button"  class="site-button" onclick = "prevQuestion(`+(currentStep-1)+`)" style="margin-right: 10px;">Back </button>
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
            if(formtype == "imageRadio" || formtype == "normalRadio"){
                optionNext =  $(".QuestionStep"+validateStep+":checked").data("nextquestionid");
                if(!(optionNext == '' || optionNext == null || optionNext == undefined )){
                    questionId = optionNext;
                }
            }
            if(questionId == null){
                htmlMaker(null,null,null,'yes');
            }else{
                getQuestions(null,questionId);
            }
        }   
    }
    
    function validateAnswer(formtype ,validateStep){
        var value = '';
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
        serviceName = $("#ServiceName").text();
        text = 'Are you sure you want to close the '+serviceName+ ' service ?';
        confirmMessage = confirm(text);
        if(confirmMessage){
            $(".step").remove();
            $("#serverOtp").val('');
            $("#otp").val('');
            $("#otpDiv").css('display','none');
            $("#phoneNumber").prop('readonly', false);
            $('#otpButton').prop('disabled', false);
            $("#otpButton").html('Send OTP');
            $('#QuestionModel').modal('toggle'); 
        }
    }

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

    function servicepopup(){
        service = $("#categorysrh").val();
        if(service == "" || service == undefined){
            $("#serviceError").css("display","block");
        }else{
            $("#serviceError").css("display","none");
            serviceName = $("#servicedata"+service).data("servicename");
            console.log(serviceName);
            QuestionsModel(service ,serviceName);
        }
    }
    $("#categorysrh").on("change", function() {
        service = $("#categorysrh").val();
        if(service == "" || service == undefined){
            $("#serviceError").css("display","block");
        }else{
            $("#serviceError").css("display","none");
        }
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
<script>
    function verifyPhoneNumber(){
        
        phone = $("#phoneNumber").val();

        if(phone == "" || phone == undefined ){
            $("#ErrorphoneNumber").html("Please enter phone number");
            $("#ErrorphoneNumber").css("display","block");
        }else if(!validatePhoneNumber(phone))
        {
            $("#ErrorphoneNumber").html("Invalid phone number");
            $("#ErrorphoneNumber").css("display","block");
        }else{
            $("#ErrorphoneNumber").html("");
            $("#ErrorphoneNumber").css("display","none");
            $("#mobileVerification").css("display","none");
            sendOTP(phone).then((otp) => {
                serverOtp = $("#serverOtp").val(otp);
                $("#otpDiv").css("display","block");
                $("#otpButton").html("Re-Send OTP");
            }).catch((error) => {
                console.error('Error:', error);
            });
        }
    }
    function verifyOtp(){
        var serverOtp = $("#serverOtp").val();
        var userEnteredOtp = $("#otp").val();

        if(serverOtp != null){
            if(serverOtp == $("#otp").val()){
                $("#phoneNumber").prop('readonly', true);
                $("#otpDiv").css("display","none");
                $("#otpButton").html("✔ Verified");
                $('#otpButton').prop('disabled', true);
            }else{
                alert("Invalid otp");
            }
        }


    }

    async function sendOTP() {
        var sendOtp = '{{route("sendOtp")}}';
        try {
            const response = await fetch(sendOtp, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    // Add any data you want to send to the server
                    phone: phone
                })
            });

            if (!response.ok) {
                throw new Error('Failed to send OTP');
            }

            const data = await response.json();
            return data.otp; // Return the OTP from the response
        } catch (error) {
            console.error('Error:', error);
            return null; // Return null in case of error
        }
    }
    function validatePhoneNumber(phoneNumber) {
        // Define the regular expression pattern
        const pattern = /^\d{10}$/;

        // Test the phone number against the pattern
        return pattern.test(phoneNumber);
    }
    </script>
@endsection