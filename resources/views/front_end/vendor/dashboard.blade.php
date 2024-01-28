@extends('front_end.vendor.layouts.master')
@section('content')
    <div class="content-admin-main">
                    
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

        <div class="row">
            <div class="col-xl-8 col-lg-12 m-b30 break-1300">
                <div class="card aon-card">
                    <div class="card-body aon-card-body">
                        <div class="row">
                            <div class="col-lg-4 m-b30">
                                <div class="panel panel-default ser-card-default">
                                    <div class="panel-body ser-card-body ser-puple p-a30">
                                        <div class="ser-card-title">Credits</div>
                                        <div class="ser-card-icons"><img src="{{asset('frontEnd/images/wallet.png')}}" alt=""/></div>
                                        <div class="ser-card-amount">{{$vendorDetails->credits}}</div>
                                        <div class="ser-card-table">
                                            <div class="ser-card-left">
                                                <div class="ser-card-total">
                                                    <div class="ser-total-table">
                                                        <div class="ser-total-cell1">Total</div>
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
                            </div>
                            <div class="col-lg-4 m-b30">
                                <a href="{{route('vendor-leads')}}">
                                    <div class="panel panel-default ser-card-default">
                                        <div class="panel-body ser-card-body ser-orange p-a30">
                                            <div class="ser-card-title">Leads</div>
                                            <div class="ser-card-icons"><img src="{{asset('frontEnd/images/booking.png')}}" alt=""/></div>
                                            <div class="ser-card-amount">{{$data['totalLeads']}}</div>
                                            <div class="ser-card-table">
                                                <div class="ser-card-left">
                                                    <div class="ser-card-total">
                                                        <div class="ser-total-table">
                                                            <div class="ser-total-cell1">Total</div>
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
                                            <div class="ser-card-title">Response</div>
                                            <div class="ser-card-icons"><img src="{{asset('frontEnd/images/earning.png')}}" alt=""/></div>
                                            <div class="ser-card-amount">{{$data['totalResponses']}}</div>
                                            <div class="ser-card-table">
                                                <div class="ser-card-left">
                                                    <div class="ser-card-total">
                                                        <div class="ser-total-table">
                                                            <div class="ser-total-cell1">Total</div>
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
                
            </div>
            
            <div class="col-xl-4 col-lg-12 m-b30 break-1300">
                <div class="card aon-card">
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
                </div>
            </div>
        </div>


        <div class="row">
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
        </div>
        
    </div>

@endsection