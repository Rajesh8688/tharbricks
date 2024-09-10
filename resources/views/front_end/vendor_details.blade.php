@extends('front_end.layouts.master')
<?php $vendorUrl = route('vendor.details' , ['id' =>encrypt($vendor->id)]) ;
$VendorName = !empty($vendor->vendorDetails->company_name)?$vendor->vendorDetails->company_name : $vendor->name ;
?>

@section('headMetaData')
    {{-- <title> Tharbricks Vendor - {{ $VendorName }}</title> --}}

    <!-- Open Graph Meta Tags for Facebook, WhatsApp, and others -->
    <meta property="og:title" content="{{ $VendorName }}"  />
    <meta property="og:description" content="{{ Str::limit($vendor->vendorDetails->company_description ?? '', 150) }}" />
    <meta property="og:url" content="{{ $vendorUrl }}" />
    <meta property="og:image" content="{{!empty($vendor->profile_pic) ? asset('uploads/users/'.$vendor->profile_pic) : asset('frontEnd/images/svg/tharBricks.svg')}}" />
    <meta property="og:type" content="article" />

    <!-- Twitter Cards Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $VendorName }}">
    <meta name="twitter:description" content="{{ Str::limit($vendor->vendorDetails->company_description ?? '', 150) }}">
    <meta name="twitter:image" content="{{!empty($vendor->profile_pic) ? asset('uploads/users/'.$vendor->profile_pic) : asset('frontEnd/images/svg/tharBricks.svg')}}">

    <!-- Additional meta tags (e.g., for SEO) -->
@endsection
@section('extrastyle')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
@section('content')    
   <!-- Content -->
   <div class="page-content">
    <!--Top Banner Section Start-->
    <div class="sf-profile-banner-full">
        <div class="container sf-proBnrfull-container">
            <div class="sf-proBnrfull-row">
                <!--Top Banner Left-->
                <?php $image = !empty($vendor->vendorDetails->company_logo) ? $vendor->vendorDetails->company_logo : 'frontEnd/images/svg/tharBricks.svg';
                $image = asset('frontEnd/images/svg/tharBricks.svg');?>
                <div class=" sf-proBnrfull-left" style="background-image: url({{$image}})">

                </div>
                {{-- <div class=" sf-proBnrfull-left" style="padding: 0px">
                    <img src="{{$image}}" alt="" >
                </div> --}}
                <!--Top Banner Right-->
                <div class=" sf-proBnrfull-right">
                    <h2 class=" sf-proBnrfull-heading">{{$vendor->vendorDetails->company_name?? $vendor->name }}</h2>
                    <div class=" sf-proBnrfull-tagline">{{$vendor->description ?? ''}}</div>
                </div>
          </div>
        </div>
    </div>
    <!--Top Banner Section End-->

    <!--Nav Section Start-->
    <div class="sf-page-scroll-wrap sf-page-scroll-wrap2">
      <div class="container">
        <div class="sf-page-scroll-nav clearfix">
          <ul class="clearfix">
            <li><a href="#aon-provider-info">{{__('lang.about')}}</a></li>
            <li><a href="#aon-provider-services">{{__('lang.service')}}</a></li>
            <li><a href="#aon-provider-Req-quote">{{__('lang.request_a_quote')}}</a></li>
            <li><a href="#aon-provider-coInfo">{{__('lang.contact_information')}}</a></li>
            <li><a href="#aon-provider-video">{{__('lang.photos')}}</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!--Nav Section End-->

    <div class="container">
        <!--About Provider-->           
        <div class="sf-provi-bio-box cleafix margin-b-50 sf-provi-fullBox">
            <!--Left-->
            <div class="sf-provi-bio-left">
                <div class="sf-provi-bio-info">   

                    <div class="sf-provi-pic">
                        <img src="{{!empty($vendor->profile_pic) ? asset('uploads/users/'.$vendor->profile_pic) : asset('frontEnd/images/default-vendor-image.png')}}" alt="">
                    </div>
                    <div class="sf-provi-gallery">
                        @foreach ($vendorImages as $key=>$image)
                        <a class="elem pic-long" href="{{asset('uploads/company/'.$image->image)}}"> {{($key == 0) ? count($vendorImages) . ' Photos' : ''}}</a>
                        @endforeach
                    </div>
                    <div class="sf-ow-pro-rating">
                        @if(!empty($vendor->reviews_sum_rating))
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $vendor->reviews_sum_rating)
                                    <span class="fa fa-star" style="color: gold"></span>
                                @else
                                    <span class="fa fa-star text-gray" style="color: black"></span>
                                @endif
                            @endfor
                        @else
                            <span class="fa fa-star" style="color: gold"></span>
                            <span class="fa fa-star" style="color: gold"></span>
                            <span class="fa fa-star" style="color: gold"></span>
                            <span class="fa fa-star" style="color: gold"></span>
                            <span class="fa fa-star" style="color: gold"></span>
                        @endif
                    </div>
                    
                </div>

            </div>
            <!--Right-->
            <div class="sf-provi-bio-right">    

                <h3 class="sf-provi-title">{{__('lang.about_vendor')}}</h3>
                <div class="sf-provi-cat"><strong>{{__('lang.services')}}:</strong>
                    @forEach($userServices as $Userservice)
                        <span>{{$Userservice->service->name}} ,</span>
                    @endforeach
                    
              
                </div>
                <div class="sf-provi-bio-text">
                    @if (!empty($vendor->vendorDetails->company_description))
                    <p>{{$vendor->vendorDetails->company_description ?? ''}}</p>
                    @else
                        <p>{{__('lang.no_description')}}</p>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    @endif

                    <p>{{$vendor->vendorDetails->company_description ?? ''}}</p>

                </div>
                
                <div class="sf-provi-social-row d-flex flex-wrap justify-content-between">
                
                    <div class="sf-provi-social">
                        <ul class="share-social-bx">
                            
                          <li class="fb"><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($vendorUrl) }}" target="_blank"> <i class="fa fa-facebook"></i> {{__('lang.share')}} </a></li>
                          <li class="tw"><a href="https://twitter.com/intent/tweet?url={{ urlencode($vendorUrl) }}&text={{ urlencode($VendorName) }}" target="_blank"> <i class="fa fa-twitter"></i> {{__('lang.share')}} </a></li>
                          <li class="lin"><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($vendorUrl) }}&title={{ urlencode($VendorName) }}"> <i class="fa fa-linkedin"></i> {{__('lang.share')}} </a></li>
                          <li style= "background: #E4405F;"><a href="copyToClipboard('{{ $vendorUrl }}')"> <i class="fa fa-instagram"></i> {{__('lang.share')}} </a></li>
                          <li style= "background: #25D366;"><a href="https://wa.me/?text={{ urlencode($vendorUrl) }}" target="_blank"> <i class="fa fa-whatsapp"></i> {{__('lang.share')}} </a></li>
                          {{-- <li class="gp"><a href="javascript:;"> <i class="fa fa-google-plus"></i> {{__('lang.share')}} </a></li> --}}
                
                        </ul>
                    </div>

                    <div class="social-share-icon social-share-icon2">
                      <div class="social-share-cell">
                          <strong>Explore Us On Social Media</strong>
                      </div>
                      <div class="social-share-cell">
                        {{-- <ul class="share-buttons">
                          <li><a class="fb-share" href="{{$tharBricksSettings->facebook_url ?? 'javascript:void(0);'}}" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a></li>
                          <li><a class="twitter-share" href="{{$tharBricksSettings->x_url ?? 'javascript:void(0);'}}" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a></li>
                          <li><a class="linkedin-share" href="https://wa.me/{{$tharBricksSettings->whatsapp_number}}" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                          <li><a class="linkedin-share"  href="{{$tharBricksSettings->instagram_url ?? 'javascript:void(0);'}}" target="_blank" rel="nofollow"><i class="fa fa-linkedin"></i></a></li>
                          <li><a class="pinterest-share" href="{{$tharBricksSettings->linked_in_url ?? 'javascript:void(0);'}}" target="_blank" rel="nofollow"><i class="fa fa-pinterest"></i></a></li>
                        </ul> --}}
                        <ul class="share-buttons">
                            <li><a class="fb-share" href="{{$vendor->vendorDetails->facebook_url ?? 'javascript:void(0);'}}" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="twitter-share" href="{{$vendor->vendorDetails->x_url ?? 'javascript:void(0);'}}" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="linkedin-share" href="https://wa.me/{{$vendor->vendorDetails->whatsapp_number?? ''}}" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                            <li><a class="linkedin-share"  href="{{$vendor->vendorDetails->instagram_url ?? 'javascript:void(0);'}}" target="_blank" rel="nofollow"><i class="fa fa-linkedin"></i></a></li>
                            <li><a class="pinterest-share" href="{{$vendor->vendorDetails->linked_in_url ?? 'javascript:void(0);'}}" target="_blank" rel="nofollow"><i class="fa fa-pinterest"></i></a></li>
                          </ul>
                      </div>
                    </div>
                    
                </div>

            </div>
        </div>
        <!--About Provider End-->
        
        <!--Service List Start-->
        {{-- <div id="aon-provider-services" class="sf-provi-service-box m-b50 sf-provi-fullBox">
            <h3 class="sf-provi-title">Service</h3>
            <div class="sf-divider-line"></div>
            <ul class="sf-provi-service-list">
                <li class="sf-provi-service-box">

                    <div class="sf-provi-service-top">
                        <div class="sf-provi-service-left">
                            <h4 class="sf-provi-service-ttle"><span class="sf-provi-toggle-btn">+</span> 3 bedroom or a house <span>Offer</span></h4>
                            <div class="sf-provi-service-price">$124.00</div>
                            <div class="sf-provi-service-hour"><i class="fa fa-clock-o"></i>Hour</div>
                        </div>
                        <div class="sf-provi-service-right">
                            <button class="site-button btn-schedules">Schedule</button>
                        </div>

                    </div>
                    <div class="sf-provi-service-bottom">
                        <div class="sf-provi-descriptio">Many serives have a wide spectrum of expertise in web solutions within these industries, giving us the necessary skills and knowledge.</div>

                    </div>
                </li>
                <li class="sf-provi-service-box">

                    <div class="sf-provi-service-top">
                        <div class="sf-provi-service-left">
                            <h4 class="sf-provi-service-ttle"><span class="sf-provi-toggle-btn">+</span> 3 bedroom or a house <span>Offer</span></h4>
                            <div class="sf-provi-service-price">$124.00</div>
                            <div class="sf-provi-service-hour"><i class="fa fa-clock-o"></i>Hour</div>
                        </div>
                        <div class="sf-provi-service-right">
                            <button class="site-button btn-schedules">Schedule</button>
                        </div>

                    </div>
                    <div class="sf-provi-service-bottom">
                        <div class="sf-provi-descriptio">Many serives have a wide spectrum of expertise in web solutions within these industries, giving us the necessary skills and knowledge.</div>

                    </div>
                </li>
                <li class="sf-provi-service-box">

                    <div class="sf-provi-service-top">
                        <div class="sf-provi-service-left">
                            <h4 class="sf-provi-service-ttle"><span class="sf-provi-toggle-btn">+</span> 3 bedroom or a house <span>Offer</span></h4>
                            <div class="sf-provi-service-price">$ 12.00/Hour</div>
                        </div>
                        <div class="sf-provi-service-right">
                            <div class="sf-provi-service-count">
                                <input id="demo1" type="text" value="55" name="demo1">
                            </div>
                            <button class="site-button btn-schedules">Schedule</button>
                        </div>

                    </div>
                    <div class="sf-provi-service-bottom">
                        <div class="sf-provi-descriptio">Many serives have a wide spectrum of expertise in web solutions within these industries, giving us the necessary skills and knowledge.</div>
                    </div>
                </li>
                <li class="sf-provi-service-box">

                    <div class="sf-provi-service-top">
                        <div class="sf-provi-service-left">
                            <h4 class="sf-provi-service-ttle"><span class="sf-provi-toggle-btn">+</span> 3 bedroom or a house <span>Offer</span></h4>
                            <div class="sf-provi-service-price">$ 10.00/Hour</div>
                        </div>
                        <div class="sf-provi-service-right">
                            <div class="sf-provi-service-count">
                                <input id="demo2" type="text" value="55" name="demo1">
                            </div>
                            <button class="site-button btn-schedules">Schedule</button>
                        </div>

                    </div>
                    <div class="sf-provi-service-bottom">
                        <div class="sf-provi-descriptio">Many serives have a wide spectrum of expertise in web solutions within these industries, giving us the necessary skills and knowledge.</div>
                    </div>
                </li>
            </ul>
            <div class="servi-leRi-btn d-flex flex-wrap justify-content-between">
                <div class="servi-le-btn">                             
                    <button class="btn btn-custom"><i class="feather-chevron-up"></i></button>
                    <button class="btn btn-custom"><i class="feather-chevron-down"></i></button>
                </div>                         
                <div class="servi-Ri-btn">
                    <button class="btn btn-custom aon-sm-btn-dark">Continue</button>
                </div>
            </div>
        </div> --}}
        <!--Service List End-->
        
        <!--Request a Quote-->
        <div id="aon-provider-Req-quote" class="sf-provi-qoute-box cleafix m-b50 sf-provi-fullBox">
            <h3 class="sf-provi-title">{{__('lang.request_a_quote')}}</h3>
            <div class="sf-divider-line"></div>                
            <div class="sf-provi-qform">
                <form  method="post" action="{{route('submitContactUs')}}">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @csrf
                    <input type="hidden" name="vendor_id" value="{{$vendor->id_user}}">
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" name="phone" placeholder="Phone" class="form-control  @error('phone') is-invalid @enderror" required>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                       
                    </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>subject</label>
                            <input type="text" name="subject" placeholder="Subject" class="form-control  @error('subject') is-invalid @enderror" required>
                            @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>
                    <div class="col-md-12">
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" placeholder="Message" class="form-control @error('message') is-invalid @enderror" required></textarea>
                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group text-center qout-submit-btn">
                        <input type="submit" value="Send information" class="site-button">
                    </div>
                    </div>
                    </div>
                </form>
            </div>
            
            
        </div>

        <!--Cotact Information-->
        <div id="aon-provider-coInfo" class="sf-provi-coInfo-box margin-b-50 sf-provi-fullBox">
            <h3 class="sf-provi-title">{{__('lang.contact_information')}}</h3>
            <div class="sf-divider-line"></div>
            <div class="row">
                <div class="col-md-5">
                    <div class="sf-provi-coInfo-map sf-provi-coInfo-map-full">
                        <div class="gmap-area">
                            <iframe src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="sf-provi-coInfo-hour sf-list-business-hours sf-bot-divider">
                        <ul class="list-unstyled sf-bh-wrapper">
                        {{-- <li>
                            <span>Monday<b>:</b></span><span>08:00 am to 06:00 pm</span>
                            <ul class="sf-bh-breaktime"></ul>
                        </li>
                        <li>
                            <span>Tuesday<b>:</b></span><span>08:00 am to 06:00 pm</span>
                            <ul class="sf-bh-breaktime"></ul>
                        </li>
                        <li>
                            <span>Wednesday<b>:</b></span><span>08:00 am to 06:00 pm</span>
                            <ul class="sf-bh-breaktime"></ul>
                        </li>
                        <li>
                            <span>Thursday<b>:</b></span><span>08:00 am to 06:00 pm</span>
                            <ul class="sf-bh-breaktime"></ul>
                        </li>
                        <li>
                            <span>Friday<b>:</b></span><span>08:00 am to 06:00 pm</span>
                            <ul class="sf-bh-breaktime"></ul>
                        </li>
                        <li>
                            <span>Saturday<b>:</b></span><span>Closed</span>
                        </li>
                        <li>
                            <span>Sunday<b>:</b></span><span>Closed</span>
                        </li> --}}
                        <li>
                            <span>{{__('lang.facebook')}}<b>:</b></span><span>@if(!empty($vendor->vendorDetails->facebook_url))
                                <a href="{{$vendor->vendorDetails->facebook_url}}">{{$vendor->vendorDetails->facebook_url}}</a>
                                @else
                                {{__('lang.not_available')}}
                                @endif
                            </span>
                            <ul class="sf-bh-breaktime"></ul>
                        </li>
                        <li>
                            <span>{{__('lang.twitter')}}<b>:</b></span><span>@if(!empty($vendor->vendorDetails->twitter_url))
                                <a href="{{$vendor->vendorDetails->twitter_url}}">{{$vendor->vendorDetails->twitter_url}}</a>
                                @else
                                {{__('lang.not_available')}}
                                @endif
                            </span>
                            <ul class="sf-bh-breaktime"></ul>
                        </li>
                        <li>
                            <span>{{__('lang.linkedin')}}<b>:</b></span><span>@if(!empty($vendor->vendorDetails->linked_in_url))
                                <a href="{{$vendor->vendorDetails->linked_in_url}}">{{$vendor->vendorDetails->linked_in_url}}</a>
                                @else
                                {{__('lang.not_available')}}
                                @endif
                            </span>
                            <ul class="sf-bh-breaktime"></ul>
                        </li>
                        <li>
                            <span>{{__('lang.pinterest')}}<b>:</b></span><span>@if(!empty($vendor->vendorDetails->pinterest_url))
                                <a href="{{$vendor->vendorDetails->pinterest_url}}">{{$vendor->vendorDetails->pinterest_url}}</a>
                                @else
                                {{__('lang.not_available')}}
                                @endif
                            </span>
                            <ul class="sf-bh-breaktime"></ul>
                        </li>
                        <li>
                            <span>{{__('lang.instagram')}}<b>:</b></span><span>@if(!empty($vendor->vendorDetails->instagram_url))
                                <a href="{{$vendor->vendorDetails->instagram_url}}">{{$vendor->vendorDetails->instagram_url}}</a>
                                @else
                                {{__('lang.not_available')}}
                                @endif
                            </span>
                            <ul class="sf-bh-breaktime"></ul>
                        </li>
                        <li>
                            <span>{{__('lang.whatsapp')}}<b>:</b></span><span>@if(!empty($vendor->vendorDetails->whatsapp_number))
                                <a href="https://wa.me/{{$vendor->vendorDetails->whatsapp_number}}">{{$vendor->vendorDetails->whatsapp_number}}</a>
                                @else
                                {{__('lang.not_available')}}
                                @endif
                            </span>
                            <ul class="sf-bh-breaktime"></ul>
                        </li>
                       
                        
                        </ul>
                    </div>
                    <div class="row d-flex flex-wrap a-b-none">
                        <div class="col-md-6">
                            <div class="sf-provi-coInfo-box">
                            <h5>{{__('lang.address')}}</h5>
                            <div class="sf-provi-coInfo-text">{{$vendor->vendorDetails->company_address ?? '---'}}</div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sf-provi-coInfo-box">
                            <h5>{{__('lang.telephone')}}</h5>  
                            <div class="sf-provi-coInfo-text">{{__('lang.mobile')}}: +91 {{$vendor->mobile ?? '---'}}</div>
                                @if(!empty($vendor->vendorDetails->alter_mobile))
                                <div class="sf-provi-coInfo-text">{{__('lang.alt_mobile')}}: +91{{$vendor->vendorDetails->alter_mobile ?? '---'}}</div>
                                @endif
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="sf-provi-coInfo-box">
                            <h5>{{__('lang.email')}}</h5>  
                            <div class="sf-provi-coInfo-text">{{$vendor->email ?? '---'}}</div>
                         
                            </div>
                        </div>                                    
                        <div class="col-md-6">
                            <div class="sf-provi-coInfo-box">
                            <h5>{{__('lang.website')}}</h5>  
                            <div class="sf-provi-coInfo-text">{{$vendor->vendorDetails->website?? '---'}}</div>
                       
                            </div>
                        </div>                                    
                    </div>
                </div>
            </div>
        
        </div>

        <!--Language-->
        {{-- <div class="sf-provi-laexce-box margin-b-50 sf-provi-fullBox">
            <div class="sf-custom-tabs sf-custom-new">
              <ul class="nav nav-tabs nav-table-cell font-20">
                <li><a data-toggle="tab" href="#tab-111" class="active">Language </a></li>
                <li><a data-toggle="tab" href="#tab-222">Experience</a></li>
                <li><a data-toggle="tab" href="#tab-333">Certificates & Awards </a></li>  
              </ul>
              <div class="tab-content">
                <div id="tab-111" class="tab-pane active">
                  <div class="sf-languages-tab">
                    <ul class="sf-languages-list sf-languages-list-new clearfix">
                      <li><span><img src="images/maps/af.png" alt=""></span> Afrikaans</li>
                      <li><span><img src="images/maps/ar.png" alt=""></span> Arabic</li>
                      <li><span><img src="images/maps/ca.png" alt=""></span> Catalan</li>
                      <li><span><img src="images/maps/da.png" alt=""></span> Danish</li>
                      <li><span><img src="images/maps/de.png" alt=""></span> German</li>
                      <li><span><img src="images/maps/fr.png" alt=""></span> French</li>
                      <li><span><img src="images/maps/ga.png" alt=""></span> Irish</li>
                      <li><span><img src="images/maps/th.png" alt=""></span> Thai</li>
                      <li><span><img src="images/maps/tr.png" alt=""></span> Turkish</li>
                    </ul>

                  </div>
                </div>
                <div id="tab-222" class="tab-pane ">
                  <div class="sf-document-tab">
                    <div class="sf-experience-acord" id="experience-acord">
                      <div class="panel sf-panel">
                        <div class="acod-head acc-actives">
                          <h6 class="acod-title text-uppercase"> <a data-toggle="collapse" href="#experience34" data-parent="#experience-acord"> <span class="exper-author">Java Programmer</span> <span class="exper-slogan">Tata Consultancy Pvt. Ltd.</span> <span class="exper-date"><i class="fa fa-clock-o"></i> Jul 01 2018 -  Jul 01 2020</span> </a></h6>
                        </div>
                        <div id="experience34" class="acod-body collapse in">
                          <div class="acod-content p-tb15">I am working as senior Java Programmer.</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="tab-333" class="tab-pane ">
                  <div class="sf-document-tab">
                    <ul class="sf-certificates-list">
                      <li>
                        <div class="awards-pic"><img src="images/java-150x150-34.jpg" alt=""></div>
                        <span class="awards-title">Java Certified Programmer</span> <span class="awards-date"><i class="fa fa-clock-o"></i> Mar 12 2019</span>
                        <div class="awards-text"></div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>  
        </div> --}}

        <!--Video-->
        <div id="aon-provider-video" class="sf-provi-vido-box margin-b-50 sf-provi-fullBox">
            <h3 class="sf-provi-title">{{__('lang.photos')}}</h3>
            <div class="sf-divider-line"></div>
            @if(count($vendorImages) != 0)
            <div class="owl-carousel aon-video-carousel aon-owl-arrow">
                @forEach($vendorImages as $vImage)
                    <div class="item">
                        <div class="sf-video-box sf-videoBox-full">
                            <div class="sf-video-pic" style="background-image:url({{asset('uploads/company/'.$vImage->image)}});"> </div>
                            {{-- <a class="sf-video-play-btn mfp-video" href="https://www.youtube.com/watch?v=GLhzTrtGO3A"><i class="fa fa-play"></i></a> --}}
                        </div>
                    </div>
              @endforeach
                   
                
               
            </div>
            @else
            <div style="text-align: center;font-size: large;font-weight: 800;">
             
                {{__('lang.no_photos_available')}}
            </div>
            @endif
        </div>

        <!--Amenities & Features-->
        {{-- <div class="sf-provi-amqudo-box margin-b-50 sf-provi-fullBox">
        <div class="sf-custom-tabs sf-custom-new">
          <ul class="nav nav-tabs nav-table-cell font-20">
            <li><a data-toggle="tab" href="#tab-1111" class="active">Amenities & Features  </a></li>
            <li><a data-toggle="tab" href="#tab-2222">Qualification</a></li>
            <li><a data-toggle="tab" href="#tab-3333">Documents</a></li>  
          </ul>
          <div class="tab-content">
            <div id="tab-1111" class="tab-pane active">
              <div class="sf-languages-tab">
                <ul class="sf-features-list sf-features-list-new clearfix">
                  <li><span class="features-icon"><img src="images/amenities/credit_card-20x20.png" alt=""></span> Accepts Credit Cards</li>
                  <li><span class="features-icon"><img src="images/amenities/coffee-1-20x20.png" alt=""></span> Coffee</li>
                  <li><span class="features-icon"><img src="images/amenities/coupons-20x20.png" alt=""></span> Coupons</li>
                  <li><span class="features-icon"><img src="images/amenities/car-20x20.png" alt=""></span> Parking street</li>
                  <li><span class="features-icon"><img src="images/amenities/wheelchair-20x20.png" alt=""></span> Wheelchair Accesible</li>
                  <li><span class="features-icon"><img src="images/amenities/wifi-20x20.png" alt=""></span> Wireless Internet</li>
                </ul>

              </div>
            </div>
            <div id="tab-2222" class="tab-pane ">
              <div class="sf-documents-tab">
                <div class="sf-qualification-acord" id="qualification-acord">
                  <div class="panel sf-panel">
                    <div class="acod-head acc-actives">
                      <h6 class="acod-title text-uppercase"> <a data-toggle="collapse" href="#qualification34" data-parent="#qualification-acord"> <span class="exper-author"> B.Tech</span> <span class="exper-slogan">Charles Andrew University</span> <span class="exper-date"><i class="fa fa-clock-o"></i> 2012 -  2016</span> </a></h6>
                    </div>
                    <div id="qualification34" class="acod-body collapse in">
                      <div class="acod-content p-tb15">I am an engineer and have B.Tech degree.</div>
                    </div>
                  </div>
                </div>                                        
              </div>
            </div>
            <div id="tab-3333" class="tab-pane ">
              <div class="sf-documents-tab">
                <div class="table-responsive">
                  <table class="table borderless margin-0">
                    <tbody>
                      <tr>
                        <td><div class="panel panel-default">
                            <div class="panel-heading"> <a download="Microsoft-Office-Excel-Worksheet-46.xlsx" href="contact-us.html"> <strong class="price-bx"><i class="fa fa-download"></i></strong> <span class="service-title">Microsoft-Office-Excel-Worksheet-46.xlsx</span> </a></div>
                          </div></td>
                        <td><div class="panel panel-default">
                            <div class="panel-heading"> <a download="Microsoft-Office-PowerPoint-Presentation-28.pptx" href="contact-us.html"> <strong class="price-bx"><i class="fa fa-download"></i></strong> <span class="service-title">Microsoft-Office-PowerPoint-Presentation-28.pptx</span> </a></div>
                          </div></td>
                      </tr>
                      <tr>
                        <td><div class="panel panel-default">
                            <div class="panel-heading"> <a download="Microsoft-Office-Word-Document-26.docx" href="contact-us.html"> <strong class="price-bx"><i class="fa fa-download"></i></strong> <span class="service-title">Microsoft-Office-Word-Document-26.docx</span> </a></div>
                          </div></td>
                        <td><div class="panel panel-default">
                            <div class="panel-heading"> <a download="PDF-Document-28.pdf" href="contact-us.html"> <strong class="price-bx"><i class="fa fa-download"></i></strong> <span class="service-title">PDF-Document-28.pdf</span> </a></div>
                          </div></td>
                      </tr>
                      <tr>
                        <td><div class="panel panel-default">
                            <div class="panel-heading"> <a download="Text-Document-26.txt" href="contact-us.html"> <strong class="price-bx"><i class="fa fa-download"></i></strong> <span class="service-title">Text-Document-26.txt</span> </a></div>
                          </div></td>
                        <td><div class="panel panel-default">
                            <div class="panel-heading"> <a download="Microsoft-Office-PowerPoint-Presentation-29.pptx" href="contact-us.html"> <strong class="price-bx"><i class="fa fa-download"></i></strong> <span class="service-title">Microsoft-Office-PowerPoint-Presentation-29.pptx</span> </a></div>
                          </div></td>
                      </tr>
                    </tbody>
                  </table>
                </div>                                        
              </div>
            </div>
          </div>
        </div>
        </div> --}}

        <!--Articles-->
        {{-- <div id="aon-provider-articles" class="sf-provi-articles-box margin-b-50 sf-provi-fullBox">
            <h3 class="sf-provi-title">Articles</h3>
            <div class="sf-divider-line"></div>
            <ul class="sf-provi-articles-list sf-provi-articles-full d-flex flex-wrap">
                <li>
                    <div class="sf-provi-art-list d-flex flex-wrap">
                        <div class="sf-provi-art-left d-flex flex-wrap">
                            <div class="sf-provi-art-pic"><img src="images/pro-pic/pic1.jpg" alt=""></div>
                            <div class="sf-provi-art-date"><i class="fa fa-calendar-o"></i> Jan 18, 2022</div>
                            <div class="sf-provi-art-comment"><i class="fa fa-comment-o"></i> Comments (25)</div>
                        </div>
                        <div class="sf-provi-art-right d-flex flex-wrap">
                            <h4  class="sf-provi-art-title">Make a medical negligence claim today</h4>
                            <div class="sf-provi-art-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</div>
                            <a href="blog-detail.html" class="sf-provi-art-btn">Read More</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="sf-provi-art-list d-flex flex-wrap">
                        <div class="sf-provi-art-left d-flex flex-wrap">
                            <div class="sf-provi-art-pic"><img src="images/pro-pic/pic2.jpg" alt=""></div>
                            <div class="sf-provi-art-date"><i class="fa fa-calendar-o"></i> Jan 18, 2022</div>
                            <div class="sf-provi-art-comment"><i class="fa fa-comment-o"></i> Comments (25)</div>
                        </div>
                        <div class="sf-provi-art-right d-flex flex-wrap">
                            <h4  class="sf-provi-art-title">Helping Companies in their Green Transition</h4>
                            <div class="sf-provi-art-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</div>
                            <a href="blog-detail.html" class="sf-provi-art-btn">Read More</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="sf-provi-art-list d-flex flex-wrap">
                        <div class="sf-provi-art-left d-flex flex-wrap">
                            <div class="sf-provi-art-pic"><img src="images/pro-pic/pic3.jpg" alt=""></div>
                            <div class="sf-provi-art-date"><i class="fa fa-calendar-o"></i> Jan 18, 2022</div>
                            <div class="sf-provi-art-comment"><i class="fa fa-comment-o"></i> Comments (25)</div>
                        </div>
                        <div class="sf-provi-art-right d-flex flex-wrap">
                            <h4  class="sf-provi-art-title">There are two thing is very important</h4>
                            <div class="sf-provi-art-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</div>
                            <a href="blog-detail.html" class="sf-provi-art-btn">Read More</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="sf-provi-art-list d-flex flex-wrap">
                        <div class="sf-provi-art-left d-flex flex-wrap">
                            <div class="sf-provi-art-pic"><img src="images/pro-pic/pic4.jpg" alt=""></div>
                            <div class="sf-provi-art-date"><i class="fa fa-calendar-o"></i> Jan 18, 2022</div>
                            <div class="sf-provi-art-comment"><i class="fa fa-comment-o"></i> Comments (25)</div>
                        </div>
                        <div class="sf-provi-art-right d-flex flex-wrap">
                            <h4  class="sf-provi-art-title">Deserunt mollit anim id est labrum.</h4>
                            <div class="sf-provi-art-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard.</div>
                            <a href="blog-detail.html" class="sf-provi-art-btn">Read More</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div> --}}

        <!--Q A-->
        <div class="sf-provi-amqudo-box margin-b-50 sf-provi-fullBox">
            <div class="sf-custom-tabs sf-custom-new">
              <ul class="nav nav-tabs nav-table-cell font-20">
                <li><a data-toggle="tab" href="#tab-11111" class="active">{{__('lang.q_a')}}</a></li>
                {{-- <li><a data-toggle="tab" href="#tab-22222">Ask Question</a></li> --}}
              </ul>
              <div class="tab-content">
                <div id="tab-11111" class="tab-pane active">
                    <ul class="sf-qes-answer-list sf-qes-answerList-full d-flex flex-wrap">
                        <li>
                            <h5 class="sf-qestion-line">1. {{__('lang.what_do_you_love_most_about_your_job')}} <i class="fa fa-plus"></i></h5>
                            <div class="sf-answer-line">{{$vendor->vendorDetails->what_do_you_love_most_about_your_job ?? '---'}}</div>
                        </li>
                        <li>
                            <h5 class="sf-qestion-line">2. {{__('lang.what_inspired_you_to_start_your_own_business')}} <i class="fa fa-plus"></i></h5>
                            <div class="sf-answer-line">{{$vendor->vendorDetails->what_inspired_you_to_start_your_own_business ?? '---'}}</div>
                        </li>
                        <li>
                            <h5 class="sf-qestion-line">3. {{__('lang.why_should_our_clients_choose_you')}} <i class="fa fa-plus"></i></h5>
                            <div class="sf-answer-line">{{$vendor->vendorDetails->why_should_our_clients_choose_you ?? '---'}}</div>
                        </li>
                        <li>
                            <h5 class="sf-qestion-line">4. {{__('lang.can_you_provide_your_service_online_or_remotely_If_so_please_add_details')}} <i class="fa fa-plus"></i></h5>
                            <div class="sf-answer-line">{{$vendor->vendorDetails->can_you_provide_your_service_online_or_remotely ?? '---'}}</div>
                        </li>
                        <li>
                            <h5 class="sf-qestion-line">5. {{__('lang.what_changes_have_made_to_keep_customers_safe_from_covid19?')}} <i class="fa fa-plus"></i></h5>
                            <div class="sf-answer-line">{{$vendor->vendorDetails->what_changes_have_made_to_keep_customers_safe_from_covid19 ?? '---'}}</div>
                        </li>
                        <li>
                            <h5 class="sf-qestion-line">6. {{__('lang.how_long_have_you_been_in_business?')}} <i class="fa fa-plus"></i></h5>
                            <div class="sf-answer-line">{{$vendor->vendorDetails->how_long_have_you_been_in_business ?? '---'}}</div>
                        </li>
                        <li>
                            <h5 class="sf-qestion-line">6.{{__('lang.what_guarantee_does_your_work_comes_with?')}} <i class="fa fa-plus"></i></h5>
                            <div class="sf-answer-line">{{$vendor->vendorDetails->what_guarantee_does_your_work_comes_with ?? '---'}}</div>
                        </li>
                    </ul>
                </div>
                {{-- <div id="tab-22222" class="tab-pane ">
                    <ul class="sf-qes-answer-list sf-qes-answerList-full d-flex flex-wrap">
                        <li>
                            <h5 class="sf-qestion-line">1. What is the return policy? <i class="fa fa-plus"></i></h5>
                            <div class="sf-answer-line">I had a v small superficial cut and my dog's saliva accidentally touched it.  His yearly rabies shot is pending and a few days back he ran away should I get vaccinated.</div>
                        </li>
                        <li>
                            <h5 class="sf-qestion-line">2. What are the shipping options? <i class="fa fa-plus"></i></h5>
                            <div class="sf-answer-line">I had a v small superficial cut and my dog's saliva accidentally touched it.  His yearly rabies shot is pending and a few days back he ran away should I get vaccinated.</div>
                        </li>
                        <li>
                            <h5 class="sf-qestion-line">3. What do I do if I never received my order? <i class="fa fa-plus"></i></h5>
                            <div class="sf-answer-line">I had a v small superficial cut and my dog's saliva accidentally touched it.  His yearly rabies shot is pending and a few days back he ran away should I get vaccinated.</div>
                        </li>
                        <li>
                            <h5 class="sf-qestion-line">4. When will I receive my order? <i class="fa fa-plus"></i></h5>
                            <div class="sf-answer-line">I had a v small superficial cut and my dog's saliva accidentally touched it.  His yearly rabies shot is pending and a few days back he ran away should I get vaccinated.</div>
                        </li>
                        
                    </ul>
                </div> --}}
              </div>
            </div>
        </div>
        
        <!--Local Customer Reviews-->
        {{-- <div id="aon-provider-review" class="sf-provi-articles-box margin-b-50 sf-provi-fullBox">
            <h3 class="sf-provi-title">Local Customer Reviews</h3>
            <div class="sf-divider-line"></div>

            <div class="sf-rating-outer sf-rating-outer-border clearfix">

              <div class="sf-rating-averages-wraps sf-rating-averages-new">
                <div class="sf-rating-averages-table">
                  <div class="sf-rating-averages-cell">
                    <div class="sf-rating-holder"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                  </div>
                  <div class="sf-rating-averages-cell">
                    <div class="sf-reviews-row">
                      <div class="sf-reviews-star"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                      <div class="sf-reviews-star-no">0</div>
                    </div>
                  </div>
                </div>
                <div class="sf-rating-averages-table">
                  <div class="sf-rating-averages-cell">
                    <div class="sf-average-rating&amp;review"><span>4.8 stars</span> - <span>921 reviews</span></div>
                  </div>
                  <div class="sf-rating-averages-cell">
                    <div class="sf-reviews-row">
                      <div class="sf-reviews-star"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                      <div class="sf-reviews-star-no">0</div>
                    </div>
                  </div>
                </div>
                <div class="sf-rating-averages-table">
                  <div class="sf-rating-averages-cell">
                    <div class="sf-completion-rate"> <span class="sf-rate-persent">92% Completion Rate</span> <span class="sf-average-question" id="example" data-toggle="tooltip" data-placement="top" title="" data-original-title="625 North Washington St, Suite 400, Alexandria, Virginia, United States"> <i class="fa fa-question-circle"></i> </span></div>
                  </div>
                  <div class="sf-rating-averages-cell">
                    <div class="sf-reviews-row">
                      <div class="sf-reviews-star"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                      <div class="sf-reviews-star-no">0</div>
                    </div>
                  </div>
                </div>
                <div class="sf-rating-averages-table">
                  <div class="sf-rating-averages-cell"> <span class="sf-completed-tasks">1081 completed tasks</span></div>
                  <div class="sf-rating-averages-cell">
                    <div class="sf-reviews-row">
                      <div class="sf-reviews-star"> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                      <div class="sf-reviews-star-no">0</div>
                    </div>
                  </div>
                </div>
                <div class="sf-rating-averages-table">
                  <div class="sf-rating-averages-cell"></div>
                  <div class="sf-rating-averages-cell">
                    <div class="sf-reviews-row">
                      <div class="sf-reviews-star"> <i class="fa fa-star"></i></div>
                      <div class="sf-reviews-star-no">0</div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="sf-rating-categories-wraps sf-rating-categories-new">
                <div class="sf-rating-categories-table">
                  <div class="sf-rating-categories-cell">Quality</div>
                  <div class="sf-rating-categories-cell">
                    <div class="sf-reviews-row">
                      <div class="sf-reviews-star"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                      <div class="sf-reviews-star-no">4.7</div>
                    </div>
                  </div>
                </div>
                <div class="sf-rating-categories-table">
                  <div class="sf-rating-categories-cell">Cost</div>
                  <div class="sf-rating-categories-cell">
                    <div class="sf-reviews-row">
                      <div class="sf-reviews-star"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                      <div class="sf-reviews-star-no">3.8</div>
                    </div>
                  </div>
                </div>
                <div class="sf-rating-categories-table">
                  <div class="sf-rating-categories-cell">Response Time</div>
                  <div class="sf-rating-categories-cell">
                    <div class="sf-reviews-row">
                      <div class="sf-reviews-star"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                      <div class="sf-reviews-star-no">2.6</div>
                    </div>
                  </div>
                </div>
                <div class="sf-rating-categories-table">
                  <div class="sf-rating-categories-cell">Timeline</div>
                  <div class="sf-rating-categories-cell">
                    <div class="sf-reviews-row">
                      <div class="sf-reviews-star"> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                      <div class="sf-reviews-star-no">1.6</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>  

            <div class="row d-flex flex-wrap a-b-none">

                <div class="col-lg-4 col-md-6">
                    <div class="sf-review-box sf-shadow-box">
                      <div class="sf-review-head clearfix">
                            <div class="sf-review-pic"><img src="images/pro-pic/pic1.jpg" alt=""/></div>
                            <div class="sf-review-info">
                              <h5 class="sf-review-name">Zohn Odriscoll</h5>
                              <div class="sf-review-feedback">Good service</div>
                            </div>
                          <div class="sf-review-date">March 12, 2022 at 5:40 am</div>
                      </div>
                      <div class="sf-review-body">
                        <ul class="sf-review-rating d-flex flex-wrap">
                            <li>
                                <div class="sf-customer-rating-names">Quality</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Cost</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Response Time</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Timeline</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                      </div>

                      <div class="sf-review-footer sf-shadow-box">
                        <span class="sf-review-write">Good service ipsum dolor sit amet, consectetur adipiscing elit vitae is vitae sapien.</span>
                        <span class="sf-review-red-less">Read More</span>
                      </div>


                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="sf-review-box sf-shadow-box">
                      <div class="sf-review-head clearfix">
                            <div class="sf-review-pic"><img src="images/pro-pic/pic2.jpg" alt=""/></div>
                            <div class="sf-review-info">
                              <h5 class="sf-review-name">Javier Bardem</h5>
                              <div class="sf-review-feedback">Good service</div>
                            </div>
                          <div class="sf-review-date">March 12, 2022 at 5:40 am</div>
                      </div>
                      <div class="sf-review-body">
                        <ul class="sf-review-rating d-flex flex-wrap">
                            <li>
                                <div class="sf-customer-rating-names">Quality</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Cost</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Response Time</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Timeline</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                      </div>

                      <div class="sf-review-footer sf-shadow-box">
                        <span class="sf-review-write">Good service ipsum dolor sit amet, consectetur adipiscing elit vitae is vitae sapien.</span>
                        <span class="sf-review-red-less">Read More</span>
                      </div>


                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="sf-review-box sf-shadow-box">
                      <div class="sf-review-head clearfix">
                            <div class="sf-review-pic"><img src="images/pro-pic/pic3.jpg" alt=""/></div>
                            <div class="sf-review-info">
                              <h5 class="sf-review-name">Mila Kunis</h5>
                              <div class="sf-review-feedback">Good service</div>
                            </div>
                          <div class="sf-review-date">March 12, 2022 at 5:40 am</div>
                      </div>
                      <div class="sf-review-body">
                        <ul class="sf-review-rating d-flex flex-wrap">
                            <li>
                                <div class="sf-customer-rating-names">Quality</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Cost</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Response Time</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Timeline</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                      </div>

                      <div class="sf-review-footer sf-shadow-box">
                        <span class="sf-review-write">Good service ipsum dolor sit amet, consectetur adipiscing elit vitae is vitae sapien.</span>
                        <span class="sf-review-red-less">Read More</span>
                      </div>


                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="sf-review-box sf-shadow-box">
                      <div class="sf-review-head clearfix">
                            <div class="sf-review-pic"><img src="images/pro-pic/pic4.jpg" alt=""/></div>
                            <div class="sf-review-info">
                              <h5 class="sf-review-name">Edward Luise</h5>
                              <div class="sf-review-feedback">Good service</div>
                            </div>
                          <div class="sf-review-date">March 12, 2022 at 5:40 am</div>
                      </div>
                      <div class="sf-review-body">
                        <ul class="sf-review-rating d-flex flex-wrap">
                            <li>
                                <div class="sf-customer-rating-names">Quality</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>

                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Cost</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Response Time</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Timeline</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                      </div>

                      <div class="sf-review-footer sf-shadow-box">
                        <span class="sf-review-write">Good service ipsum dolor sit amet, consectetur adipiscing elit vitae is vitae sapien.</span>
                        <span class="sf-review-red-less">Read More</span>
                      </div>


                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="sf-review-box sf-shadow-box">
                      <div class="sf-review-head clearfix">
                            <div class="sf-review-pic"><img src="images/pro-pic/pic5.jpg" alt=""/></div>
                            <div class="sf-review-info">
                              <h5 class="sf-review-name">James McAvoy</h5>
                              <div class="sf-review-feedback">Good service</div>
                            </div>
                          <div class="sf-review-date">March 12, 2022 at 5:40 am</div>
                      </div>
                      <div class="sf-review-body">
                        <ul class="sf-review-rating d-flex flex-wrap">
                            <li>
                                <div class="sf-customer-rating-names">Quality</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Cost</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Response Time</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Timeline</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                      </div>

                      <div class="sf-review-footer sf-shadow-box">
                        <span class="sf-review-write">Good service ipsum dolor sit amet, consectetur adipiscing elit vitae is vitae sapien.</span>
                        <span class="sf-review-red-less">Read More</span>
                      </div>


                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="sf-review-box sf-shadow-box">
                      <div class="sf-review-head clearfix">
                            <div class="sf-review-pic"><img src="images/pro-pic/pic6.jpg" alt=""/></div>
                            <div class="sf-review-info">
                              <h5 class="sf-review-name">Jackie Chan</h5>
                              <div class="sf-review-feedback">Good service</div>
                            </div>
                          <div class="sf-review-date">March 12, 2022 at 5:40 am</div>
                      </div>
                      <div class="sf-review-body">
                        <ul class="sf-review-rating d-flex flex-wrap">
                            <li>
                                <div class="sf-customer-rating-names">Quality</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Cost</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Response Time</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="sf-customer-rating-names">Timeline</div>
                                <div class="sf-customer-rating-star">
                                    <div class="sf-ow-pro-rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star text-gray"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                      </div>

                      <div class="sf-review-footer sf-shadow-box">
                        <span class="sf-review-write">Good service ipsum dolor sit amet, consectetur adipiscing elit vitae is vitae sapien.</span>
                        <span class="sf-review-red-less">Read More</span>
                      </div>


                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button class="site-button">Load More</button>
                </div>
            </div>

        </div> --}}

        <!--Related Provider-->
        {{-- <div class="sf-provi-articles-box margin-b-50 sf-provi-fullBox">
            <h3 class="sf-provi-title">Related Provider</h3>
            <div class="sf-divider-line"></div>

            <div class="owl-carousel aon-ow-provi-related aon-owl-arrow">

             
                <div class="item">
                    <div class="aon-ow-provider-wrap">
                        <div class="aon-ow-provider">

                            <div class="aon-ow-top">
                                <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                <div class="aon-ow-info">
                                    <h4 class="aon-title">Edward Luise</h4>
                                    <span>Queens, United States</span>
                                </div>
                            </div>
                            <div class="aon-ow-mid">
                                <div class="aon-ow-media">
                                    <img src="images/providers/1.jpg" alt="">
                                </div>
                                <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                <div class="aon-ow-pro-rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star text-gray"></span>
                                </div>
                            </div>
                        </div>
                        <div class="aon-ow-bottom">
                            <a href="#">Request A Quote</a>
                        </div>
                    </div>
                </div>
             
                <div class="item">
                    <div class="aon-ow-provider-wrap">
                        <div class="aon-ow-provider">

                            <div class="aon-ow-top">
                                <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                <div class="aon-ow-info">
                                    <h4 class="aon-title">Edward Luise</h4>
                                    <span>Queens, United States</span>
                                </div>
                            </div>
                            <div class="aon-ow-mid">
                                <div class="aon-ow-media">
                                    <img src="images/providers/2.jpg" alt="">
                                </div>
                                <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                <div class="aon-ow-pro-rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star text-gray"></span>
                                </div>
                            </div>
                        </div>
                        <div class="aon-ow-bottom">
                            <a href="#">Request A Quote</a>
                        </div>
                    </div>
                </div>
                
                <div class="item">
                    <div class="aon-ow-provider-wrap">
                        <div class="aon-ow-provider">

                            <div class="aon-ow-top">
                                <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                <div class="aon-ow-info">
                                    <h4 class="aon-title">Edward Luise</h4>
                                    <span>Queens, United States</span>
                                </div>
                            </div>
                            <div class="aon-ow-mid">
                                <div class="aon-ow-media">
                                    <img src="images/providers/3.jpg" alt="">
                                </div>
                                <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                <div class="aon-ow-pro-rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star text-gray"></span>
                                </div>
                            </div>
                        </div>
                        <div class="aon-ow-bottom">
                            <a href="#">Request A Quote</a>
                        </div>
                    </div>
                </div>
                
                <div class="item">
                    <div class="aon-ow-provider-wrap">
                        <div class="aon-ow-provider">

                            <div class="aon-ow-top">
                                <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                <div class="aon-ow-info">
                                    <h4 class="aon-title">Edward Luise</h4>
                                    <span>Queens, United States</span>
                                </div>
                            </div>
                            <div class="aon-ow-mid">
                                <div class="aon-ow-media">
                                    <img src="images/providers/4.jpg" alt="">
                                </div>
                                <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                <div class="aon-ow-pro-rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star text-gray"></span>
                                </div>
                            </div>
                        </div>
                        <div class="aon-ow-bottom">
                            <a href="#">Request A Quote</a>
                        </div>
                    </div>
                </div>
                
                <div class="item">
                    <div class="aon-ow-provider-wrap">
                        <div class="aon-ow-provider">

                            <div class="aon-ow-top">
                                <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                <div class="aon-ow-info">
                                    <h4 class="aon-title">Edward Luise</h4>
                                    <span>Queens, United States</span>
                                </div>
                            </div>
                            <div class="aon-ow-mid">
                                <div class="aon-ow-media">
                                    <img src="images/providers/5.jpg" alt="">
                                </div>
                                <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                <div class="aon-ow-pro-rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star text-gray"></span>
                                </div>
                            </div>
                        </div>
                        <div class="aon-ow-bottom">
                            <a href="#">Request A Quote</a>
                        </div>
                    </div>
                </div>
          
                <div class="item">
                    <div class="aon-ow-provider-wrap">
                        <div class="aon-ow-provider">

                            <div class="aon-ow-top">
                                <div class="aon-pro-check"><span><i class="fa fa-check"></i></span></div>
                                <div class="aon-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                <div class="aon-ow-info">
                                    <h4 class="aon-title">Edward Luise</h4>
                                    <span>Queens, United States</span>
                                </div>
                            </div>
                            <div class="aon-ow-mid">
                                <div class="aon-ow-media">
                                    <img src="images/providers/6.jpg" alt="">
                                </div>
                                <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                <div class="aon-ow-pro-rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star text-gray"></span>
                                </div>
                            </div>
                        </div>
                        <div class="aon-ow-bottom">
                            <a href="#">Request A Quote</a>
                        </div>
                    </div>
                </div>

            </div>  

        </div> --}}
                    

    </div>
</div>
<!-- Content END-->  
@endsection
@section('extraScripts')
<script src="{{ asset('admin-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
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
    <script>
          function copyToClipboard(text) {
        var tempInput = document.createElement("input");
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert("Link copied to clipboard! You can now share it on Instagram.");
    }
    </script>
    
@endif

@endsection