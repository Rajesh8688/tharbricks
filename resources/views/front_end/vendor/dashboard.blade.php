@extends('front_end.vendor.layouts.master')
@section('content')
<style>
    .page-seller-home a.noline {
    text-decoration: none;
}
.text-xs {
    font-size: .975em;
}
.text-grey-200 {
    color: #ced0da!important;
}
 a.noline.hover-dark:hover {
    color: #111637!important
}

.page-seller-home .avatar-container {
    font-size: 1.75em;
}

.default-avatar.default-avatar-80 {
    width: 80px;
    height: 80px;
}
.default-avatar {
    border-radius: 50%;
    width: 2.25em;
    height: 2.25em;
    text-transform: uppercase;
}
.bg-site-colour {
    background-color: #DF5901!important;
}
.text-lg {
    font-size: 2.125em;
}
 .seller-company-name {
    max-height: 68px;
    height: auto;
    line-height: 34px;
    overflow-y: hidden;
}
.text-grey-400 {
    color: #9da0b6!important;
}
.text-secondary {
    color: #6c7191!important;
}
.text-dark-blue {
    color: #111637!important;
}

    
    </style>
    <div class="content-admin-main px-4 px-xl-7">
                    
        {{-- <div class="admin-top-area d-flex flex-wrap justify-content-between m-b30 align-items-center">
            
            <div class="admin-left-area">
                <a class="nav-btn-admin d-flex justify-content-between align-items-center" id="sidebarCollapse">
                    <span class="nav-btn-text">Dashboard Menu</span>
                    <span class="fa fa-reorder"></span>
                </a>
            </div>
            
            <div class="admin-area-mid">
                <div class="admin-area-heading">
                    <span>Your Tariff Plan : </span>
                    <strong>Extended <i class="fa fa-caret-down"></i></strong>
                </div>
                <div class="admin-area-content">you Are on Extended . Use link bellow to view details or upgrade.Details </div>
                
            </div>
            
            <div class="admin-right-area">
                <div class="pro-pic-info-wrap d-flex">
                    <div class="pro-pic-box">
                        <img src="images/user.jpg" alt=""/>
                    </div>
                    <div class="pro-pic-info">
                        <strong>David Wood</strong>
                        <span>Designer</span>
                    </div>
                    <span class="feather-icon has-toltip">
                        <i class="feather-power"></i>
                        <span class="header-toltip">Notification</span>
                    </span>
                </div>
            </div>
        </div> --}}
        @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12 m-b30">
                <div class="card aon-card">
                    <div class="card-body aon-card-body">
                        <div class="row">
                            <div class="col-lg-4 m-b30">
                                <a href="{{route('my-credits')}}">
                                    <div class="panel panel-default ser-card-default">
                                        <div class="panel-body ser-card-body ser-puple p-a30">
                                            <div class="ser-card-title">{{__('lang.credits')}}</div>
                                            <div class="ser-card-icons"><img src="{{asset('frontEnd/images/wallet.png')}}" alt=""/></div>
                                            <div class="ser-card-amount">{{$vendorDetails->credits}}</div>
                                            <div class="ser-card-table">
                                                <div class="ser-card-left">
                                                    <div class="ser-card-total">
                                                        <div class="ser-total-table">
                                                            <div class="ser-total-cell1">{{__('lang.total')}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ser-card-right">
                                                    <div class="ser-card-icon"><i class="glyph-icon flaticon-money-3"></i></div>
                                                </div>
                                            </div>
                                            <span class="ser-card-circle-bg"></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 m-b30">
                                <a href="{{route('vendor-leads')}}">
                                    <div class="panel panel-default ser-card-default">
                                        <div class="panel-body ser-card-body ser-orange p-a30">
                                            <div class="ser-card-title">{{__('lang.leads')}}</div>
                                            <div class="ser-card-icons"><img src="{{asset('frontEnd/images/booking.png')}}" alt=""/></div>
                                            <div class="ser-card-amount">{{$data['totalLeads']}}</div>
                                            <div class="ser-card-table">
                                                <div class="ser-card-left">
                                                    <div class="ser-card-total">
                                                        <div class="ser-total-table">
                                                            <div class="ser-total-cell1">{{__('lang.total')}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ser-card-right">
                                                    <div class="ser-card-icon"><i class="glyph-icon flaticon-wallet"></i></div>
                                                </div>
                                            </div>
                                            <span class="ser-card-circle-bg"></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 m-b30">
                                <a href="{{route('my-tharbricks')}}">
                                    <div class="panel panel-default ser-card-default">
                                        <div class="panel-body ser-card-body ser-blue p-a30">
                                            <div class="ser-card-title">{{__('lang.response')}}</div>
                                            <div class="ser-card-icons"><img src="{{asset('frontEnd/images/earning.png')}}" alt=""/></div>
                                            <div class="ser-card-amount">{{$data['totalResponses']}}</div>
                                            <div class="ser-card-table">
                                                <div class="ser-card-left">
                                                    <div class="ser-card-total">
                                                        <div class="ser-total-table">
                                                            <div class="ser-total-cell1">{{__('lang.total')}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ser-card-right">
                                                    <div class="ser-card-icon"><i class="glyph-icon flaticon-calendar"></i></div>
                                                </div>
                                            </div>
                                            <span class="ser-card-circle-bg"></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class= "row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card aon-card">
                            <div class="d-flex align-items-start justify-content-start flex-column px-3 py-2">
                                <div class="avatar-container">
                                    <div class="d-inline-flex">
                                        <div class="default-avatar default-avatar-80 text-lg bg-site-colour d-inline-flex text-white justify-content-center align-items-center">
                                            <div style="color: #402909">{{ucfirst(substr(auth()->user()->name,0,1))}}</div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mb-0 seller-company-name">{{ucfirst(auth()->user()->name)}}</h4>
                            </div>
                            <div class="px-3 pb-3">
                                <div class="border-top pt-3 js-profile-completeness">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap font-bolder" >
                                        <p class="text-xs mb-0">{{__('lang.your_profile_is_complete_percentage' , ['percentage' => $data['percentage']])}}</p>
                                        <a href="{{url('vendor/edit#aon-about-panel')}}" class="text-grey-200 text-xs hover-dark noline">Edit</a>
                                    </div>
                                    <div class="mt-4">
                                        <div class="progress" style="height:8px">
                                            <div class="progress-bar" role="progressbar" style="width: {{$data['percentage']}}%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-secondary my-3 text-xs">
                                    {{__('lang.completing_your_profile_is_a_great_way_to_appeal_to_customers')}}
                                    
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card aon-card">
                            <div class="card-header aon-card-header aon-card-header2"><h4>{{__('lang.help')}}</h4></div>
                            <div class="card-body" style="padding:1.0rem !important">
                                <hr>
                                <div class="tab-content">
                                    <div class="content mx-2">
                                        <div class="content px-4 d-flex justify-content-start align-items-start flex-row mt-3 font-bolder" >
                                           <i class="fa fa-question-circle" style="padding-top: 10px;"></i>
                                            <div class="text-dark-blue text-xs ml-2">
                                                <p class="text-left mb-3">
                                                    {{__('lang.visit')}} <a class="text-nowrap text-dark-blue hover-light" href="#"><u>{{__('lang.help_centre')}}</u></a>{{__('lang.for_tips_advice')}}
                                                </p>
                                                <p class="text-left mb-2">
                                                    {{__('lang.email')}} <a class="text-dark-blue text-nowrap noline" href="mailto:{{$data['email']}}">{{$data['email']}}</a>
                                                </p>
                                                <p class="text-dark-blue mb-0">
                                                    {{__('lang.call')}} <a class="text-nowrap text-dark-blue" href="tel:+91{{$data['phone_number']}}">+91 {{$data['phone_number']}}</a>
                                                </p>
                                                <p class="text-xs text-grey-400   mb-0">
                                                    {{__('lang.avilability')}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    
        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-12 m-b30">
                <div class="card aon-card">
                    <div class="card-header aon-card-header aon-card-header2"><h4>{{__('lang.lead_settings')}}</h4></div>
                    <div class="card-body" style="padding: 1rem !important">
                        <hr>
                        <div class="tab-content">
                            <div class="content mx-2">
                                <div class="d-flex justify-content-between align-items-center mb-1 font-bolder" >
                                    <p class="mb-0 text-md">Services</p>
                                    <a href="{{url('vendor/edit#aon-category-panel')}}" class="text-grey-200 noline hover-dark text-xs">
                                        Edit
                                    </a>
                                </div>
                                <p class="text-secondary text-xs">{{__('lang.Youll_receive_leads_in_these_services')}}</p>
                                <div class="widget_tag_cloud ">                   
                                    <div class="tagcloud">
                                        @foreach ($data['services'] as $service)
                                        <a>{{$service->service->name}}</a>
                                        @endforeach
                                       
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="content mx-2">
                                <div class="d-flex justify-content-between align-items-center mb-1 font-bolder" >
                                    <p class="mb-0 text-md">{{__('lang.locations')}}</p>
                                    <a href="{{url('vendor/edit#aon-category-panel')}}" class="text-grey-200 noline hover-dark text-xs">{{__('lang.edit')}}</a>
                                </div>
                                <p class="text-secondary text-xs">{{__('lang.Youre_receiving_customers_within')}}</p>
                                    <div class="locations d-flex flex-column justify-content-around align-items-start">
                                        <div class="d-flex justify-content-start align-items-center my-1 mw-100">
                                            <span class="bark-svg-icon bsi-primary-grey-200 bsi-sm mr-2">
                                                <i class="fa fa-map-marker"></i>
                                            </span>
                                            <p class="text-sm text-grey-800 location mb-0 text-truncate text-capitalize">K R Puram</p>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center my-1 mw-100">
                                            <span class="bark-svg-icon bsi-primary-grey-200 bsi-sm mr-2">
                                                <i class="fa fa-map-marker"></i>
                                            </span>
                                            <p class="text-sm text-grey-800 location mb-0 text-truncate text-capitalize">Bengaluru</p>
                                        </div>
                                    </div>
                            </div>
                            <hr>
                            <div class="content mx-2">
                                <div class="d-flex justify-content-between align-items-center mb-1 font-bolder" >
                                    <p class="mb-0 text-md">{{__('lang.sending_new_leads_to')}}</p>
                                    <a href="{{url('vendor/edit#aon-about-panel')}}" class="text-grey-200 noline hover-dark text-xs">
                                        <u>Change</u>
                                    </a>
                                </div>
                                <span class="text-dark-blue text-xs text-break">{{auth()->user()->email}}</span>
                             </div>

                        </div>
                    </div>
                </div>
                {{-- <div class="card aon-card">
                    <div class="card-header aon-card-header aon-card-header2"><h4><i class="feather-bell"></i> Notifications</h4></div>
                    <div class="card-body aon-card-body">
                        
                        <div class="tab-content">
                            <div id="accepted11" class="tab-pane active">
                                <div class="ws-poptab-list-wrap notification-scroll">
                                    <!--list One-->
                                    <div class="ws-poptab-list">
                                        <div class="ws-poptab-media">
                                            <img src="images/testimonials2/pic1.jpg" alt="">
                                        </div>
                                        <div class="ws-poptab-info">
                                            <strong>Maria Smith</strong>
                                            <p>David wood requested to change.</p>
                                            <span class="ws-time-duration">8 mins ago</span>
                                        </div>
                                    </div>

                                    <!--list Two-->
                                    <div class="ws-poptab-list">
                                        <div class="ws-poptab-media">
                                            <img src="images/testimonials2/pic2.jpg" alt="">
                                        </div>
                                        <div class="ws-poptab-info">
                                            <strong>Zonsan Wood</strong>
                                            <p>David wood requested to change.</p>
                                            <span class="ws-time-duration">4 mins ago</span>
                                        </div>
                                    </div>

                                    <!--list three-->
                                    <div class="ws-poptab-list">
                                        <div class="ws-poptab-media">
                                            <img src="images/testimonials2/pic3.jpg" alt="">
                                        </div>
                                        <div class="ws-poptab-info">
                                            <strong>Denisa Wood</strong>
                                            <p>David wood requested to change.</p>
                                            <span class="ws-time-duration">2 mins ago</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="ws-poptab-all text-center">
                                    <a href="#" class="btn-link-type">View All</a>
                                </div>                                                    

                            </div>

                        </div>
                    </div>
                </div> --}}
            </div>
        </div>




        {{-- <div class="row">
            <div class="col-xl-8 m-b30">
                <div class="card aon-card">
                    <div class="card-header aon-card-header aon-card-header2"><h4><i class="feather-pie-chart"></i> Booking</h4></div>
                    <div class="card-body aon-card-body">
                        <div class="dx-viewport demo-container">
                            <div id="chart-demo">
                            <div id="chart"></div>
                            <div class="action">
                                <div class="label">Choose a temperature threshold, &deg;C: </div>
                                <div id="choose-temperature"></div>
                            </div>
                            </div>
                        </div>


                    </div>
                </div>
                
            </div>
            
            <div class="col-xl-4">
                <div class="card aon-card">
                    <div class="card-header aon-card-header aon-card-header2"><h4><i class="feather-pie-chart"></i> Booking Stats</h4></div>
                    <div class="card-body aon-card-body">
                        <div>
                            <ul class="list-unstyled">
                                <li class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs rounded-circle m-r10">
                                            <i class="feather-check-circle"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-2">Completed</p>
                                            <div class="progress progress-sm animated-progess">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs rounded-circle m-r10">
                                            <i class="feather-calendar"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-2">Pending</p>
                                            <div class="progress progress-sm animated-progess">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs align-self-center me-3">
                                            <div class="avatar-xs rounded-circle m-r10">
                                            <i class="feather-x-circle"></i>
                                        </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-2">Cancel</p>
                                            <div class="progress progress-sm animated-progess">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 19%" aria-valuenow="19" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <hr>
                        <div class="text-center">
                            <div class="row aon-states-row">
                                <div class="col-4">
                                    <div class="mt-2">
                                        <p class="text-muted mb-2">Completed</p>
                                        <h5 class="font-size-16 mb-0">70</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-2">
                                        <p class="text-muted mb-2">Pending</p>
                                        <h5 class="font-size-16 mb-0">45</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-2">
                                        <p class="text-muted mb-2">Cancel</p>
                                        <h5 class="font-size-16 mb-0">19</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        
    </div>

@endsection