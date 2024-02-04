@extends('front_end.vendor.layouts.master')
@section('content')
    <style>
        .dz-image img {
            height: 120px;
        }
    </style>

    <div class="content-admin-main">
        
     
        
        <div class="aon-provi-tabs  flex-wrap justify-content-between">
            <div class="aon-provi-left">
                <ul class="aon-provi-links">
                    <li><a href="#aon-about-panel">About</a></li>
                    <li><a href="#aon-contact-panel">Company</a></li>
                    {{-- <li><a href="#aon-adress-panel">Address</a></li> --}}
                    <li><a href="#aon-socialMedia-panel">Social Media</a></li>
                    <li><a href="#aon-category-panel">Services</a></li>
                    <li><a href="#aon-gallery-panel">Gallery</a></li>
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
            <strong>Success!</strong> {{session('success-info')}}
        </div>
        @endif
        @if(session('error-info'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> {{session('error-info')}}
        </div>
        @endif
        <div class="card aon-card">
            <div class="card-header aon-card-header"><h4><i class="fa fa-user"></i> About</h4></div>
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
                                            <span class="header-toltip">Upload Avtar</span>
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
                                            <span>Upload Company Logo</span>
                                            <input type="file" name="company_logo">
                                        </div>
                                    </div>
                                </div>
                                <div class="aon-staff-avtar-footer">
                                    <h4 class="aon-staff-avtar-title">Upload</h4>
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
                                        <label>First Name</label>
                                        <div class="aon-inputicon-box"> 
                                            <input class="form-control sf-form-control" name="first_name" type="text" placeholder="First Name" value="{{old('first_name', auth()->user()->first_name)}}">
                                            <i class="aon-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <div class="aon-inputicon-box"> 
                                            <input class="form-control sf-form-control" name="last_name" type="text" placeholder="Last Name" value="{{old('last_name', auth()->user()->last_name)}}">
                                            <i class="aon-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
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
                                        <label>Email</label>
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
                                        <label>Biography</label>
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
                                <button type="button"  class="site-button"  style="margin-right: 10px;">Cancle </button>
                                <button type="submit"  class="site-button" >Submit </button>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div>   

        <div class="card aon-card" id="aon-contact-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-address-card"></i> Comapny Details</h4></div>
            <form method="POST" action="{{route('update-company-details')}}">
                <div class="card-body aon-card-body">
                    <div class="row">
                    @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control" name="company_name" type="text" value="{{old('company_name', $vendorDetails->company_name)}}">
                                    <i class="aon-input-icon fa fa-building-o"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Website</label>
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
                                <label>Mobile</label>
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
                                <label>Alt Mobile</label>
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
                                <label>Company Size </label>
                                <select class="sf-select-box form-control sf-form-control bs-select-hidden form-control" name="company_size" data-live-search="true" title="Company Size"><option class="bs-title-option" value="">Company Size</option>
                                
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
                                <label>Years in business</label>
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control" name="years_in_business" placeholder="Years In Business" type="number" value="{{old('years_in_business', $vendorDetails->years_in_business)}}">
                                    <i class="aon-input-icon fa fa-skype"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Describe your company</label>
                                <div class="editer-wrap">
                                    <div class="editer-textarea">
                                        <textarea class="form-control" rows="6" naame ="company_description">{{old('years_in_business', $vendorDetails->company_description)}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <div class ="col-12" >
                            <div  style="float:right">
                                <button type="button"  class="site-button"  style="margin-right: 10px;">Cancle </button>
                                <button type="submit"  class="site-button" >Submit </button>
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
            <div class="card-header aon-card-header"><h4><i class="fa fa-share-alt"></i> Social Media</h4></div>
            <div class="card-body aon-card-body">
                <form method="POST" action = "{{route('update-vendor-social-account-details')}}">
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Facebook</label>
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
                                <label>Twitter</label>
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
                                <label> Linkedin</label>
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
                                <label>Instagram</label>
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
                                <button type="button"  class="site-button"  style="margin-right: 10px;">Cancle </button>
                                <button type="submit"  class="site-button" >Submit </button>
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
            <div class="card-header aon-card-header"><h4><i class="fa fa-list-alt"></i> Services</h4></div>
            <form method="POST" action ="{{route('update-vendor-services')}}">
                @csrf
                <div class="card-body aon-card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Services</label>
                            
                                <select class="selectpicker" multiple data-live-search="true" name="serviceId[]">
                                    @foreach ($services as $item)
                                        <option  {{ in_array($item->id, old('serviceId', $userServicesIds) ?: []) ? 'selected' : '' }} value ="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class ="col-12" >
                            <div  style="float:right">
                                <button type="button"  class="site-button"  style="margin-right: 10px;"> Cancle </button>
                                <button type="submit"  class="site-button"> Submit </button>
                            </div>
                        </div> 
                    </div>
                   
                    {{-- <p>Enter same password in both fields. Use an uppercase letter and a number for stronger password.</p> --}}
                </div>
            </form>
        </div>



    

        <div class="card aon-card" id="aon-gallery-panel">
            <div class="card-header aon-card-header"><h4><i class="fa fa-image"></i> Gallery Images</h4>
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

@endsection
@section('extraScripts')



    <script>
        // Array of existing image URLs
        var existingImages = {!! json_encode($existingImages) !!};

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

    </script>


@endsection