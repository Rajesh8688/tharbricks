@extends('front_end.vendor.layouts.master')
@section('content')
    <style>
        .dz-image img {
            height: 120px;
        }
 
        .error-message {
            color: red;
            display: none;
        }
        .error {
            color: red;
        }

    </style>

    <div class="content-admin-main">
        
     
        
        <div class="aon-provi-tabs  flex-wrap justify-content-between">
            <div class="aon-provi-left">
                <ul class="aon-provi-links">
                    <li><a href="#aon-about-panel">{{__('lang.about')}}</a></li>
                    <li><a href="#aon-contact-panel">{{__('lang.company')}}</a></li>
                    {{-- <li><a href="#aon-adress-panel">Address</a></li> --}}
                    <li><a href="#aon-socialMedia-panel">{{__('lang.social_media')}}</a></li>
                    <li><a href="#aon-category-panel">{{__('lang.services')}}</a></li>
                    <li><a href="#aon-location-panel">{{__('lang.locations')}}</a></li>
                    <li><a href="#aon-qa-panel">{{__('lang.q_a')}}</a></li>
                    <li><a href="#aon-gallery-panel">{{__('lang.gallery')}}</a></li>
                
                    {{--<li><a href="#aon-video-panel">Video</a></li>
                     <li><a href="#aon-serviceArea-panel">Service Area</a></li>
                    <li><a href="#aon-servicePer-panel">Service Perform</a></li>
                  
                    <li><a href="#aon-passUpdate-panel">Password</a></li>
                    
                    <li><a href="#aon-amenities-panel">Amenities</a></li>
                    <li><a href="#aon-languages-panel">Languages</a></li> --}}
              
                </ul>
            </div>
            <div class="aon-provi-right">
            
            </div>	
        </div> 


        <div class="aon-admin-heading">
            <h4>Edit Profile</h4>
        </div>                
        @if(session('success-info'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>{{__('lang.success')}}!</strong> {{session('success-info')}}
        </div>
        @endif
        @if(session('error-info'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>{{__('lang.error')}}!</strong> {{session('error-info')}}
        </div>
        @endif
        <div class="card aon-card">
            <div class="card-header aon-card-header"><h4><i class="fa fa-user"></i> {{__('lang.about')}}</h4></div>
            <div class="card-body aon-card-body">
        
               
                <form method="POST" action="{{route('update-user-details')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="aon-staff-avtar">
                                <div class="aon-staff-avtar-header">
                                    <div class="aon-pro-avtar-pic ">
                                        @if(!empty(auth()->user()->profile_pic))
                                        <img src="{{asset('uploads/users/'.auth()->user()->profile_pic)}}" alt="" >
                                        @else
                                        <img src="{{asset('frontEnd/images/default-avatar.png')}}" alt="" >
                                        @endif
                                        <button class="admin-button has-toltip">
                                            <i class="fa fa-camera"></i>
                                            <span class="header-toltip">{{__('lang.upload_avtar')}}</span>
                                            <input type="file" name="profile_pic">
                                        </button>
                                    </div>
                                    <div class="aon-pro-cover-wrap">
                                        <div class="aon-pro-cover-pic">
                                            @if(!empty($vendorDetails->company_logo))
                                            <img src="{{asset('uploads/company/'.$vendorDetails->company_logo)}}" alt="" >
                                            @else
                                            <img src="{{asset('frontEnd/images/banner/job-banner.jpg')}}" alt="" >
                                            @endif
                                        </div>
                                        <div class="admin-button-upload">
                                            <span>{{__('lang.upload_company_logo')}}</span>
                                            <input type="file" name="company_logo">
                                        </div>
                                    </div>
                                </div>
                                <div class="aon-staff-avtar-footer">
                                    <h4 class="aon-staff-avtar-title">{{__('lang.upload')}}</h4>
                                    <ul>
                                        {{-- <li>Min width and height: <span>600 x 600 px</span></li> --}}
                                        <li>Max Upload Size: <span>512MB</span></li>
                                        <li>Extensions: <span>JPEG,PNG,GIF,PNG</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('lang.first_name')}}</label>
                                        <div class="aon-inputicon-box"> 
                                            <input class="form-control sf-form-control" name="first_name" type="text" placeholder="First Name" value="{{old('first_name', auth()->user()->first_name)}}">
                                            <i class="aon-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('lang.last_name')}}</label>
                                        <div class="aon-inputicon-box"> 
                                            <input class="form-control sf-form-control" name="last_name" type="text" placeholder="Last Name" value="{{old('last_name', auth()->user()->last_name)}}">
                                            <i class="aon-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('lang.username')}}</label>
                                        <div class="aon-inputicon-box"> 
                                            <input class="form-control sf-form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="UserName" value="{{old('name', auth()->user()->name)}}">
                                            <i class="aon-input-icon fa fa-user"></i>
                                        </div>
                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('lang.email')}}</label>
                                        <div class="aon-inputicon-box"> 
                                            <input class="form-control sf-form-control  @error('email') is-invalid @enderror" name="email" type="email" value="{{old('email', auth()->user()->email)}}">
                                            <i class="aon-input-icon fa fa-envelope"></i>
                                        </div>
                                        @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 breck-w1400">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <div class="aon-inputicon-box"> 
                                            <div class="radio-inline-box sf-radio-check-row">
                                                <div class="checkbox sf-radio-checkbox sf-radio-check-2 sf-raChe-6">
                                                    <input id="any111" name="abc" value="five" type="radio">
                                                    <label for="any111">Male</label>
                                                </div>
                                                <div class="checkbox sf-radio-checkbox sf-radio-check-2 sf-raChe-6">
                                                    <input id="body111" name="abc" value="five" type="radio">
                                                    <label for="body111">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__('lang.biography')}}</label>
                                        <div class="editer-wrap">
                                            <div class="editer-textarea">
                                                <textarea class="form-control" rows="6" naame ="bio">{{old('description', auth()->user()->description)}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class ="col-12" >
                            <div  style="float:right">
                                <button type="button"  class="site-button"  style="margin-right: 10px;">{{__('lang.cancle')}} </button>
                                <button type="submit"  class="site-button" >{{__('lang.submit')}} </button>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div>   

        <div class="card aon-card" id="aon-contact-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-address-card"></i> {{__('lang.comapny_details')}}</h4></div>
            <form method="POST" action="{{route('update-company-details')}}">
                <div class="card-body aon-card-body">
                    <div class="row">
                    @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.company_name')}}</label>
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control" name="company_name" type="text" value="{{old('company_name', $vendorDetails->company_name)}}">
                                    <i class="aon-input-icon fa fa-building-o"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{__('lang.website')}}</label>
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control  @error('website') is-invalid @enderror" name="website" type="text" value="{{old('website', $vendorDetails->website)}}">
                                    <i class="aon-input-icon fa fa-globe"></i>
                                </div>
                                @error('website')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.mobile')}}</label>
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control @error('mobile') is-invalid @enderror" name="mobile" type="text" value="{{old('mobile', $vendorDetails->mobile)}}">
                                    <i class="aon-input-icon fa fa-phone"></i>
                                </div>
                                @error('mobile')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.alt_mobile')}}</label>
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control @error('alter_mobile') is-invalid @enderror" name="alter_mobile" type="text" value="{{old('alter_mobile', $vendorDetails->alter_mobile)}}">
                                    <i class="aon-input-icon fa fa-phone"></i>
                                </div>
                                @error('alter_mobile')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label>{{__('lang.company_size')}} </label>
                                <select class="sf-select-box form-control sf-form-control bs-select-hidden form-control" name="company_size" data-live-search="true" title="Company Size"><option class="bs-title-option" value="">{{__('lang.company_size')}}</option>
                                
                                    <option value="1"  {{ old('company_size', $vendorDetails->company_size) == '1' ? 'selected' : '' }}> Self-employed, Sole trader</option>
                                    <option value="2" {{ old('company_size', $vendorDetails->company_size) == '2' ? 'selected' : '' }}> 2-10</option>
                                    <option value="3" {{ old('company_size', $vendorDetails->company_size) == '3' ? 'selected' : '' }}> 11-50</option>
                                    <option value="4" {{ old('company_size', $vendorDetails->company_size) == '4' ? 'selected' : '' }}> 51-200</option>
                                    <option value="5" {{ old('company_size', $vendorDetails->company_size) == '5' ? 'selected' : '' }}> 200+</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.years_in_business')}}</label>
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control" name="years_in_business" placeholder="Years In Business" type="number" value="{{old('years_in_business', $vendorDetails->years_in_business)}}">
                                    <i class="aon-input-icon fa fa-skype"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('lang.describe_your_company')}}</label>
                                <div class="editer-wrap">
                                    <div class="editer-textarea">
                                        <textarea class="form-control" rows="6" naame ="company_description">{{old('years_in_business', $vendorDetails->company_description)}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('lang.locations')}}</label>
                                <div class="grayscle-area address-area-map">
                                    <iframe height="460" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.8534521658976!2d-118.2533646842856!3d34.073270780600225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c6fd9829c6f3%3A0x6ecd11bcf4b0c23a!2s1363%20Sunset%20Blvd%2C%20Los%20Angeles%2C%20CA%2090026%2C%20USA!5e0!3m2!1sen!2sin!4v1620815366832!5m2!1sen!2sin"></iframe>
                                </div>
                                
                                <button class="button rwmb-map-goto-address-button btn btn-primary m-t20" value="address"> {{__('lang.find_address_on_map')}} </button>
                                <p>Note: This will load your address on map and fillup latitude and longitude</p>
                                
                            </div>
                        </div>
                        <div class ="col-12" >
                            <div  style="float:right">
                                <button type="button"  class="site-button"  style="margin-right: 10px;">{{__('lang.cancle')}} </button>
                                <button type="submit"  class="site-button" >{{__('lang.submit')}} </button>
                            </div>
                        </div> 
                        
                        
                    </div>
                </div>
            </form>
        </div>  

        {{-- <div class="card aon-card" id="aon-adress-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-address-card"></i> Address</h4></div>
            <div class="card-body aon-card-body">
                <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                            <label>Location</label>
                            <div class="grayscle-area address-area-map">
                                <iframe height="460" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.8534521658976!2d-118.2533646842856!3d34.073270780600225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c6fd9829c6f3%3A0x6ecd11bcf4b0c23a!2s1363%20Sunset%20Blvd%2C%20Los%20Angeles%2C%20CA%2090026%2C%20USA!5e0!3m2!1sen!2sin!4v1620815366832!5m2!1sen!2sin"></iframe>
                            </div>
                            
                            <button class="button rwmb-map-goto-address-button btn btn-primary m-t20" value="address"> Find Address on Map </button>
                            <p>Note: This will load your address on map and fillup latitude and longitude</p>
                            
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <div class="aon-inputicon-box"> 
                                <input class="form-control sf-form-control" name="company_name" type="text">
                                <i class="aon-input-icon fa fa-globe"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Apt/Suite #</label>
                            <div class="aon-inputicon-box"> 
                                <input class="form-control sf-form-control" name="company_name" type="text">
                                <i class="aon-input-icon fa fa-map-marker"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>City</label>
                            <div class="aon-inputicon-box"> 
                                <input class="form-control sf-form-control" name="company_name" type="text">
                                <i class="aon-input-icon fa fa-map-marker"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>State</label>
                            <div class="aon-inputicon-box"> 
                                <input class="form-control sf-form-control" name="company_name" type="text">
                                <i class="aon-input-icon fa fa-map-marker"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Postal Code</label>
                            <div class="aon-inputicon-box"> 
                                <input class="form-control sf-form-control" name="company_name" type="text">
                                <i class="aon-input-icon fa fa-map-marker"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Country</label>
                            <div class="aon-inputicon-box"> 
                                <input class="form-control sf-form-control" name="company_name" type="text">
                                <i class="aon-input-icon fa fa-map-marker"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Latitude</label>
                            <div class="aon-inputicon-box"> 
                                <input class="form-control sf-form-control" name="company_name" type="text">
                                <i class="aon-input-icon fa fa-street-view"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Longitude</label>
                            <div class="aon-inputicon-box"> 
                                <input class="form-control sf-form-control" name="company_name" type="text">
                                <i class="aon-input-icon fa fa-street-view"></i>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>  --}}

        {{-- <div class="card aon-card" id="aon-serviceArea-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-building-o"></i> Radius for Service Area</h4></div>
            <div class="card-body aon-card-body">
                <div class="row">
                    

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="sf-range-slider sf-range-w250">
                                <div class="sf-range-slider-control">Radius: <span>45Km</span></div>
                                <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14"/>
                            </div>
                        </div>
                    </div>
                                                
                    
                </div>
            </div>
        </div>  --}}

        {{-- <div class="card aon-card" id="aon-servicePer-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-building-o"></i> Service to Perform At</h4></div>
            <div class="card-body aon-card-body">
                <div class="row">
                    

                    <div class="col-md-12">
                        <div class="aon-inputicon-box"> 

                            <div class="radio-inline-box service-perform-list">

                                <div class="checkbox sf-radio-checkbox sf-radio-check-2">
                                    <input id="loc11" name="abc" value="five" type="radio">
                                    <label for="loc11">My Location</label>
                                </div>
                                <div class="checkbox sf-radio-checkbox sf-radio-check-2">
                                    <input id="loc22" name="abc" value="five" type="radio">
                                    <label for="loc22">Customer Location</label>
                                </div>
                                <div class="checkbox sf-radio-checkbox sf-radio-check-2">
                                    <input id="loc33" name="abc" value="five" type="radio">
                                    <label for="loc33">Both</label>
                                </div>

                            </div>

                        </div>
                    </div>
                                                
                    
                </div>
            </div>
        </div> --}}
        
        <div class="card aon-card" id="aon-socialMedia-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-share-alt"></i> {{__('lang.social_media')}}</h4></div>
            <div class="card-body aon-card-body">
                <form method="POST" action = "{{route('update-vendor-social-account-details')}}">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.facebook')}}</label>
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control  @error('facebook_url') is-invalid @enderror" name="facebook_url" type="text" value="{{old('facebook_url', $vendorDetails->facebook_url)}}">
                                    <i class="aon-input-icon fa fa-facebook"></i>
                                </div>
                                @error('facebook_url')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.twitter')}}</label>
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control @error('twitter_url') is-invalid @enderror" name="twitter_url" type="text" value="{{old('twitter_url', $vendorDetails->twitter_url)}}">
                                    <i class="aon-input-icon fa fa-twitter"></i>
                                </div>
                                @error('twitter_url')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{__('lang.linkedin')}}</label>
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control @error('linked_in_url') is-invalid @enderror" name="linked_in_url" type="text" value="{{old('linked_in_url', $vendorDetails->linked_in_url)}}">
                                    <i class="aon-input-icon fa fa-linkedin"></i>
                                </div>
                                @error('linked_in_url')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Pinterest</label>
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control @error('pinterest_url') is-invalid @enderror" name="pinterest_url" type="text" value="{{old('pinterest_url', $vendorDetails->pinterest_url)}}">
                                    <i class="aon-input-icon fa fa-pinterest"></i>
                                </div>
                                @error('pinterest_url')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.instagram')}}</label>
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control @error('instagram_url') is-invalid @enderror" name="company_name" type="text" value="{{old('instagram_url', $vendorDetails->instagram_url)}}">
                                    <i class="aon-input-icon fa fa-instagram"></i>
                                </div>
                                @error('instagram_url')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class ="col-12" >
                            <div  style="float:right">
                                <button type="button"  class="site-button"  style="margin-right: 10px;">{{__('lang.cancle')}} </button>
                                <button type="submit"  class="site-button" >{{__('lang.submit')}} </button>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div> 
        
        {{-- <div class="card aon-card" id="aon-passUpdate-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-lock"></i> Password Update</h4></div>
            <div class="card-body aon-card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>New Password</label>
                            <div class="aon-inputicon-box"> 
                                <input class="form-control sf-form-control" name="company_name" type="text">
                                <i class="aon-input-icon fa fa-lock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Repeat Password</label>
                            <div class="aon-inputicon-box"> 
                                <input class="form-control sf-form-control" name="company_name" type="text">
                                <i class="aon-input-icon fa fa-lock"></i>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <p>Enter same password in both fields. Use an uppercase letter and a number for stronger password.</p>
            </div>
        </div> --}}

        <div class="card aon-card" id="aon-category-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-list-alt"></i> {{__('lang.services')}}</h4></div>
            <form method="POST" action ="{{route('update-vendor-services')}}">
                @csrf
                <div class="card-body aon-card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('lang.services')}}</label>
                            
                                <select class="selectpicker" multiple data-live-search="true" name="serviceId[]">
                                    @foreach ($services as $item)
                                        <option  {{ in_array($item->id, old('serviceId', $userServicesIds) ?: []) ? 'selected' : '' }} value ="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class ="col-12" >
                            <div  style="float:right">
                                <button type="button"  class="site-button"  style="margin-right: 10px;"> {{__('lang.cancle')}} </button>
                                <button type="submit"  class="site-button"> {{__('lang.submit')}} </button>
                            </div>
                        </div> 
                    </div>
                   
                    {{-- <p>Enter same password in both fields. Use an uppercase letter and a number for stronger password.</p> --}}
                </div>
            </form>
        </div>

        <div class="card aon-card" id="aon-location-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-list-alt"></i> {{__('lang.locations')}}</h4> </div>
            <div class="card-body aon-card-body" id = "locationCard">
                <div >
                    <div class="row aon-avi-time-slot">
                        @forelse  ($myLocations as $location)
                            <div class="col-lg-3 col-md-4">
                                <div class="sf-avai-time-slots-wrap">
                                    <div class="pl-2">
                                        @if($location->type == "distance")
                                        <p>Within <b>{{$location->distance_value}} kms</b> of <b>{{$location->address}}</b></p>
                                        @else
                                        <p><b>{{ucfirst($location->type)}}</b> </p>
                                        @endif
                                        <p class="" style="color: gray;opacity: 0.7;font-weight: 500;">{{$location->services}} service</p>
                                    </div>
                                    <div class="sf-avai-time-slots-control" style="justify-content: center">
                                        <div class="sf-avai-time-slots-btn">
                                            <button type="button" class="btn slot-delete  has-toltip" title="{{__('lang.delete')}}" onClick="deleteLocation({{$location->id}})">
                                                <i class="fa fa-remove"> &nbsp; {{__('lang.delete')}}</i>
                                                <span class="header-toltip">{{__('lang.delete')}}</span>
                                            </button>
                                            </div>
                                        
                                        <div class="sf-avai-time-slots-btn">
                                            <button type="button" class="btn slot-update has-toltip" title="{{__('lang.update')}}" onClick="getLocation({{$location->id}})">
                                                <i class="fa fa-refresh">&nbsp; {{__('lang.update')}}</i>
                                                <span class="header-toltip">{{__('lang.update')}}</span>
                                            </button>
                                        </div>
        
                                    </div>
        
                                </div>
                            </div>
                        @empty
                        <p class="text-center">{{__('lang.no_locations_added')}}</p>
                        @endforelse
                        
                        {{-- <center>No Locations Found</center> --}}
                    </div>
                    <div class ="col-12" > 
                        <hr>
                        <div  style="float:right">
                            <button type="button"  class="site-button"  style="margin-right: 10px;margin-bottom: 26px;"> {{__('lang.cancle')}} </button>
                            <button class="site-button" data-toggle="modal" data-target="#addLocation" type="button">
                                <i class="fa fa-plus"></i>
                                {{__('lang.add_location')}}
                            </button>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        

        <div class="card aon-card" id="aon-qa-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-question-circle"></i>{{__('lang.q_a')}}</h4></div>
            <div class="card-body aon-card-body">
                <form method="POST" action = "{{route('update-vendor-questions')}}">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.what_do_you_love_most_about_your_job')}}</label>
                                <div class="editer-wrap">
                                    <div class="editer-textarea">
                                        <textarea class="form-control" rows="2" name ="what_do_you_love_most_about_your_job">{{old('what_do_you_love_most_about_your_job', $vendorDetails->what_do_you_love_most_about_your_job)}}</textarea>
                                    </div>
                                </div>
                                @error('what_do_you_love_most_about_your_job')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.what_inspired_you_to_start_your_own_business')}}</label>
                                <div class="editer-wrap">
                                    <div class="editer-textarea">
                                        <textarea class="form-control" rows="2" name ="what_inspired_you_to_start_your_own_business">{{old('what_inspired_you_to_start_your_own_business', $vendorDetails->what_inspired_you_to_start_your_own_business)}}</textarea>
                                    </div>
                                </div>
                                @error('what_inspired_you_to_start_your_own_business')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.why_should_our_clients_choose_you')}}</label>
                                <div class="editer-wrap">
                                    <div class="editer-textarea">
                                        <textarea class="form-control" rows="2" name ="why_should_our_clients_choose_you">{{old('why_should_our_clients_choose_you', $vendorDetails->why_should_our_clients_choose_you)}}</textarea>
                                    </div>
                                </div>
                                @error('why_should_our_clients_choose_you')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.can_you_provide_your_service_online_or_remotely_If_so_please_add_details')}}</label>
                                <div class="editer-wrap">
                                    <div class="editer-textarea">
                                        <textarea class="form-control" rows="2" name ="can_you_provide_your_service_online_or_remotely">{{old('can_you_provide_your_service_online_or_remotely', $vendorDetails->can_you_provide_your_service_online_or_remotely)}}</textarea>
                                    </div>
                                </div>
                                @error('can_you_provide_your_service_online_or_remotely')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.what_changes_have_made_to_keep_customers_safe_from_covid19')}}</label>
                                <div class="editer-wrap">
                                    <div class="editer-textarea">
                                        <textarea class="form-control" rows="2" name ="what_changes_have_made_to_keep_customers_safe_from_covid19">{{old('what_changes_have_made_to_keep_customers_safe_from_covid19', $vendorDetails->what_changes_have_made_to_keep_customers_safe_from_covid19)}}</textarea>
                                    </div>
                                </div>
                                @error('what_changes_have_made_to_keep_customers_safe_from_covid19')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.how_long_have_you_been_in_business')}}</label>
                                <div class="editer-wrap">
                                    <div class="editer-textarea">
                                        <textarea class="form-control" rows="2" name ="how_long_have_you_been_in_business">{{old('how_long_have_you_been_in_business', $vendorDetails->how_long_have_you_been_in_business)}}</textarea>
                                    </div>
                                </div>
                                @error('how_long_have_you_been_in_business')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('lang.what_guarantee_does_your_work_comes_with')}}</label>
                                <div class="editer-wrap">
                                    <div class="editer-textarea">
                                        <textarea class="form-control" rows="2" name ="what_guarantee_does_your_work_comes_with">{{old('what_guarantee_does_your_work_comes_with', $vendorDetails->what_guarantee_does_your_work_comes_with)}}</textarea>
                                    </div>
                                </div>
                                @error('what_guarantee_does_your_work_comes_with')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class ="col-12" >
                            <div  style="float:right">
                                <button type="button"  class="site-button"  style="margin-right: 10px;">{{__('lang.cancle')}} </button>
                                <button type="submit"  class="site-button" >{{__('lang.submit')}} </button>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div> 



    

        <div class="card aon-card" id="aon-gallery-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-image"></i> {{__('lang.gallery_images')}}</h4>
            </div>
            
            <div class="card-body aon-card-body">
                <form action="{{route('update-company-image')}}"  method="post" enctype="multipart/form-data" class="dropzone" id="my-dropzone">@csrf</form>
                
            </div>
        </div>
        
        {{-- <div class="card aon-card" id="aon-video-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-video-camera"></i> Video Upload</h4>
            </div>
            
            <div class="card-body aon-card-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Insert YouTube or Vimeo or Facebook Vedio Url" aria-label="Recipient's username">
                    <div class="input-group-append">
                    <button class="btn admin-button" type="button">Priview</button>
                    </div>
                </div>
            </div>
        </div> --}}


    </div>

    <div class="modal fade content-admin-main" id="addLocation" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog model-w800" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">{{__('lang.add_new_location')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="locationform">
                <div class="modal-body">
                    <div class="sf-md-padding">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__('lang.choose_how_you_want_to_set_your_location')}}</label>
                                    <div class="aon-inputicon-box"> 
                                        <div class="radio-inline-box"><?php $displayProperty = $showNationalwide ? "block" : "none";?>
                                            <div class="checkbox sf-radio-checkbox sf-radio-check-2" style="display:{{$displayProperty}}" id ="locationNationalWide">
                                                <input id="loc1" name="locationType" value="nationwide" type="radio" required>
                                                <label for="loc1">{{__('lang.nationwide')}}</label>
                                            </div>
                              
                                            <div class="checkbox sf-radio-checkbox sf-radio-check-2">
                                                <input id="loc2" name="locationType" value="distance" type="radio" required>
                                                <label for="loc2">{{__('lang.distance')}}</label>
                                            </div>
                                        </div>
                                        <div class="error-message" id="locationTypeError">{{__('lang.please_select_a_location_type')}}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="LocationType" style="display: none; padding: 0px 20px">
                                <div class="row">
                                    <div class="col-md-8"> 
                                        <div class="form-group">
                                            <label>{{__('lang.pin_code_city')}}</label>
                                            <div class="aon-inputicon-box"> 
                                                <input class="form-control sf-form-control" name="address" id="address" type="text" placeholder="{{__('lang.pin_code_city')}}">
                                                <i class="aon-input-icon fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-md-4"> 
                                        <div class="form-group">
                                            <label>{{__('lang.distance')}}</label>
                                            <select class="sf-select-box form-control sf-form-control bs-select-hidden form-control" name="distance_value" id="distance_value" data-live-search="true" title="{{__('lang.distance')}}">
                                                <option value="1">1 Km</option>
                                                <option value="2">2 Kms</option>
                                                <option value="5">5 Kms</option>
                                                <option value="10">10 Kms</option>
                                                <option value="20">20 Kms</option>
                                                <option value="30">30 Kms</option>
                                                <option value="50">50 Kms</option>
                                                <option value="75">75 Kms</option>
                                                <option value="100">100 Kms</option>
                                                <option value="125">125 Kms</option>
                                                <option value="150">150 Kms</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Services</label>
                                    <div class="aon-inputicon-box"> 
                                        <div class="radio-inline-box">
                                            <div class="checkbox sf-radio-checkbox sf-radio-check-2">
                                                <input id="lo1" name="services" value="all_services" type="checkbox" required>
                                                <label for="lo1">{{__('lang.all_services')}}</label>
                                            </div>
                                            @foreach($myservices as $UserService)
                                                <div class="checkbox sf-radio-checkbox sf-radio-check-2">
                                                    <input id="loSer{{$UserService->service->id}}" name="services[]" value="{{$UserService->service->id}}" type="checkbox" required>
                                                    <label for="loSer{{$UserService->service->id}}">{{ ucfirst($UserService->service->name) }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="error-message" id="servicesError">{{__('lang.please_select_at_least_one_service')}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @csrf
        
                <div class="modal-footer">
                    <button type="button" class="site-button" data-dismiss="modal">{{__('lang.cancle')}}</button>
                    <button type="button" class="site-button" id="addButton">{{__('lang.add')}}</button>
                </div>
            </form>
    
           
          </div>
        </div>
    </div>
    <div id ="updateLocationpop">
    </div>
@endsection
@section('extraScripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script> 

    <script>
        // Array of existing image URLs
        var existingImages = {!! json_encode($existingImages) !!};
        var addLocationUrl = '{{route("vendor-addLocation")}}';
        var deleteLocationUrl = '{{route("vendor-deleteLocation")}}';
        var getLocationUrl = '{{route("vendor-getLocation")}}';
        var updateLocationUrl = '{{route("vendor-updateLocation")}}';

        // Initialize Dropzone
        Dropzone.options.myDropzone =
        {
                maxFiles: 5, 
                maxFilesize: 4,
                //~ renameFile: function(file) {
                //~ var dt = new Date();
                //~ var time = dt.getTime();
                //~ return time+"-"+file.name;    // to rename file name but i didn't use it. i renamed file with php in controller.
                //~ },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                thumbnailWidth:"350",
                thumbnailHeight:"350",
                paramName: "file",

                timeout: 50000,
                init:function() {

                // Get images
                var myDropzone = this;
                $.each(existingImages, function (key, value) {

                    var file = {name: value.name, size: value.size};
                    myDropzone.options.addedfile.call(myDropzone, file);
                    myDropzone.options.thumbnail.call(myDropzone, file, value.path);
                    myDropzone.emit("complete", file);
                    });
                },
                removedfile: function(file) 
                {
                if (this.options.dictRemoveFile) {
                return Dropzone.confirm("Are You Sure to "+this.options.dictRemoveFile, function() {
                        if(file.previewElement.id != ""){
                        var name = file.previewElement.id;
                        }else{
                        var name = file.name;
                        }
                        //console.log(name);
                        $.ajax({
                        
                        type: 'POST',
                        url: '{{ url("vendor/image/delete") }}',
                        data: {"filename": name ,"_token": "{{ csrf_token() }}"},
                        success: function (data){
                        // alert(data.success +" File has been successfully removed!");
                        },
                        error: function(e) {
                        console.log(e);
                        }});
                        var fileRef;
                        return (fileRef = file.previewElement) != null ? 
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                        });
                }  
                },

                success: function(file, response) 
                {
                file.previewElement.id = response.success;
                //console.log(file); 
                // set new images names in dropzone’s preview box.
                var olddatadzname = file.previewElement.querySelector("[data-dz-name]");   
                file.previewElement.querySelector("img").alt = response.success;
                olddatadzname.innerHTML = response.success;
                },
                error: function(file, response)
                {
                        if($.type(response) === "string")
                        var message = response; //dropzone sends it's own error messages in string
                        else
                        var message = response.message;
                        file.previewElement.classList.add("dz-error");
                        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                        _results = [];
                        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                        }
                        return _results;
                }
        };

        $(document).ready(function() {
            // Get the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Show or hide the LocationType div based on radio selection
            $('input[name="locationType"]').change(function() {
                if ($(this).val() == 'distance') {
                    $('#LocationType').show();
                } else {
                    $('#LocationType').hide();
                }
                $('#locationTypeError').hide();
            });

            // Set up global AJAX settings
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Initialize form validation
            $("#locationform").validate({
                rules: {
                    locationType: {
                        required: true
                    },
                    address: {
                        required: function() {
                            return $('input[name="locationType"]:checked').val() == 'distance';
                        }
                    },
                    distance_value: {
                        required: function() {
                            return $('input[name="locationType"]:checked').val() == 'distance';
                        }
                    },
                    services: {
                        required: true
                    }
                },
                messages: {
                    locationType: {
                        required: "Please select a location type."
                    },
                    address: {
                        required: "Please enter a valid address."
                    },
                    distance_value: {
                        required: "Please select a distance."
                    },
                    services: {
                        required: "Please select at least one service."
                    }
                },
                errorPlacement: function(error, element) {
                    console.log(error);
                    console.log(element);
                 
                    if (element.attr("name") == "locationType") {
                        error.appendTo("#locationTypeError");
                    } else if (element.attr("name") == "address") {
                        error.appendTo("#addressError");
                    } else if (element.attr("name") == "distance_value") {
                        error.appendTo("#distanceError");
                    } else if (element.attr("name") == "services") {
                        error.appendTo("#servicesError");
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            // Form submission
            $('#addButton').click(function() {console.log($("#locationform").valid());
                if ($("#locationform").valid()) {
                    var formData = $('#locationform').serialize();

                    $.ajax({
                        url: addLocationUrl,
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            console.log(response);
                            $("#locationCard").html(response.locationCard);
                            // Reset the form
                            $('#addLocation').modal('hide');
                            $('#locationform')[0].reset();
                            toastr.success(response.message, 'success');
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            toastr.error(response.message, 'error');
          
                        }
                    });
                }
            });
        });
        function deleteLocation(locationId)
            {
                alert("dd");
                $.ajax({
                    url: deleteLocationUrl,
                    method: 'POST',
                    data: {"locationId": locationId},
                    success: function(response) {
                        console.log(response);
                        $("#locationCard").html(response.locationCard);
                        // Reset the form
                        $('#locationform')[0].reset();
                        toastr.success(response.message, 'success');
                        if(response.showNationalwide){
                            $("#locationNationalWide").css("display", "block");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        toastr.error(response.message, 'error');
                    }
                });
            }
        function getLocation(locationId)
        {
            $.ajax({
                url: getLocationUrl,
                method: 'GET',
                data: {"locationId": locationId},
                success: function(response) {
                    console.log(response);
                    $("#updateLocationpop").html(response.updatePopup);
                    $('#updateLocationpopup').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    toastr.error(error, 'error');
                }
            });
        }    

        function updateLocation(){
            if ($("#updatelocationform").valid()) {
                    var formData = $('#updatelocationform').serialize();

                    $.ajax({
                        url: updateLocationUrl,
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            console.log(response);
                            $("#locationCard").html(response.locationCard);
                            // Reset the form
                            
                            $('#updateLocationpopup').modal('hide');
                            $('#updatelocationform')[0].reset();
                            toastr.success(response.message, 'success');
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            toastr.error(response.message, 'error');
          
                        }
                    });
                }

        }

            

    </script>


@endsection