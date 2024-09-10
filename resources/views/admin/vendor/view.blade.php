@extends('admin.layouts.master')

@section('extrastyle')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/css/pages/app-user.css')}}">
   
    <!-- END: Page CSS-->
@endsection


@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <x-admin-breadcrumb :title="$titles['title']"></x-admin-breadcrumb>
            </div>
            <div class="content-body">
                <!-- page users view start -->
                <section class="page-users-view">
                    <div class="row">
                        <!-- account start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Vendor Details</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="users-view-image">
                                            <img src={{!empty($vendor->profile_pic) ? asset('uploads/users/'.$vendor->profile_pic) : $noImage }} class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                        </div>
                                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                            <table>
                                                <tr>
                                                    <td class="font-weight-bold">Name</td>
                                                    <td>{{$vendor->name }} </td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Email</td>
                                                    <td>{{$vendor->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Credits</td>
                                                    <td> {{$vendor->vendorDetails->credits}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-5">
                                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                                <tr>
                                                    <td class="font-weight-bold">Status</td>
                                                    <td>{{$vendor->status}}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="font-weight-bold">Phone</td>
                                                    <td>{{$vendor->mobile}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12">
                                            
                                            <a href="{{route('vendor.edit', $vendor->id)}}" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i> Edit</a>
                                            <button href="{{route('vendor.destroy', $vendor->id)}}" class="btn btn-danger mr-1"><i class="feather icon-trash-2"></i> Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- information start -->
                        <div class="col-md-6 col-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title mb-2">Company Information</div>
                                </div>
                                <div class="card-body">
                                    <table>
                                        <tr> 
                                            <td class="font-weight-bold">Company Name</td>
                                            <td>{{$vendor->vendorDetails->company_name}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Mobile</td>
                                            <td>{{$vendor->vendorDetails->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Website</td>
                                            <td>{{$vendor->vendorDetails->website}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Alter mobile</td>
                                            <td>{{$vendor->vendorDetails->alter_mobile}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Company Size</td>
                                            @switch($vendor->vendorDetails->company_size)
                                                @case(1)
                                                    <td>Self-employed, Sole trader</td>
                                                    @break
                                                @case(2)
                                                    <td>2-10</td>
                                                    @break
                                                @case(3)
                                                    <td>11-50</td>
                                                    @break
                                                @case(4)
                                                    <td>51-200</td> 
                                                    @break
                                                @case(5)
                                                    <td>200+</td>
                                                    @break
                                            @endswitch

                                        
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Years in Business</td>
                                            <td>{{$vendor->vendorDetails->years_in_business}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- information start -->
                        <!-- social links end -->
                        <div class="col-md-6 col-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title mb-2">Social Links</div>
                                </div>
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Facebook</td>
                                            <td>{{$vendor->vendorDetails->facebook_url}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Twitter Url</td>
                                            <td>{{$vendor->vendorDetails->twitter_url}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">LinkedIn</td>
                                            <td>{{$vendor->vendorDetails->linked_in_url}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Pinterest</td>
                                            <td>{{$vendor->vendorDetails->pinterest_url}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Instagram</td>
                                            <td>{{$vendor->vendorDetails->instagram_url}}
                                            </td>
                                        </tr>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- social links end -->
                        <div class="col-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title mb-2">Questions</div>
                                </div>
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">What do you love most about your job</td>
                                            <td>{{$vendor->vendorDetails->what_do_you_love_most_about_your_job}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">What inspired you to start your own business</td>
                                            <td>{{$vendor->vendorDetails->what_inspired_you_to_start_your_own_business}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Why should our clients choose you</td>
                                            <td>{{$vendor->vendorDetails->why_should_our_clients_choose_you}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Can you provide your service online or remotely</td>
                                            <td>{{$vendor->vendorDetails->can_you_provide_your_service_online_or_remotely}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">What changes have made to keep customers safe from covid19</td>
                                            <td>{{$vendor->vendorDetails->what_changes_have_made_to_keep_customers_safe_from_covid19}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="font-weight-bold">How long have you been in business</td>
                                            <td>{{$vendor->vendorDetails->how_long_have_you_been_in_business}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">What guarantee does your work comes with</td>
                                            <td>{{$vendor->vendorDetails->what_guarantee_does_your_work_comes_with}}
                                            </td>
                                        </tr>
                                      
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                        @foreach ($myservices as $service)
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$service->service->name}}</h4>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        @if(count($service->locations))
                                        
                                        @foreach($service->locations as $userServiceLocation)
                                        <li class="list-group-item">
                                            {{-- <span class="badge badge-pill bg-primary float-right">4</span> --}}
                                            @if($userServiceLocation->location->type == "nationwide")
                                                NationalWide
                                            @else
                                            Distance : {{$userServiceLocation->location->address }} with in {{$userServiceLocation->location->distance_value}} Kms
                                            @endif
                                        </li>
                                        @endforeach
                                        @else
                                        <li class="list-group-item">
                                            No Location added
                                        </li>

                                        @endif
                                        
                                      
                                    </ul>
                                  
                                </div>
                            </div>
                        </div>
                            
                        @endforeach
                        
                        {{-- <div class="col-xl-4 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">Carousel</h4>
                                        <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                                    </div>
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img src="../../../app-assets/images/slider/01.jpg" class="d-block w-100" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="../../../app-assets/images/slider/02.jpg" class="d-block w-100" alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="../../../app-assets/images/slider/03.jpg" class="d-block w-100" alt="Third slide">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                                            <span class="fa fa-angle-left icon-prev" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                                            <span class="fa fa-angle-right icon-next" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt assumenda mollitia
                                            officia dolorum eius quasi.</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                      
                     
                    </div>
                </section>
                <!-- page users view end -->
                

           
                {{-- <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Wallet Logger</div>
                                </div>

                                
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>UniqueId</th>
                                                        <th>DOT</th>
                                                        <th>Amount</th>
                                                        <th>Journey</th>
                                                        <th>Status</th>
                                                        <th>Description</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
            
                                                    @if(count($walletLogger) > 0)
                                                        @foreach($walletLogger as $log)
                                                            <tr>
                                                                <td>{{$log->unique_id}}</td>
                                                                <td>{{ \Carbon\Carbon::parse($log->date_of_transaction)->format('d M Y, h:i A') }}</td>
                                                                @if($log->action == 'added')
                                                                    <td style="color:green">
                                                                        {{"+ ".$log->amount}}
                                                                    </td>
                                                                @else
                                                                    <td  style="color:red">
                                                                        {{"- ".$log->amount}}
                                                                    </td>
                                                                @endif
            
                                                                @if($log->flight_booking_id !='')
                                                                <td  class="align-middle">
                                                                    <a  href = "#" download data-bs-toggle="tooltip" title="{{$log->FlightBooking->from ?? ''}}">{{$log->FlightBooking->from}}</a>
                                                                    @if($log->FlightBooking->booking_type == "roundtrip")
                                                                    <i class="fa fa-exchange" title="RoundTrip" ></i> 
                                                                    
                                                                    @else
                                                                    <i data-bs-toggle="tooltip" title="One Way" class="fa fa-arrow-right"></i>
                                                                    @endif
                                                                    <a  href = "#" download data-bs-toggle="tooltip" title="{{$log->FlightBooking->to ?? ''}}">{{$log->FlightBooking->to}}</a>
                                                                </td>
                                                                <td>{{$log->FlightBooking->booking_status}}</td>
                                                                @else
                                                                <td>---</td>
                                                                <td>---</td>
                                                                @endif
                                                                <td>{{$log->amount_description}}</td>
                                                                
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr align="center" class="alert alert-danger">
                                                            <td colspan="6">No Record(s)</td>
                                                        </tr>
                                                    @endif
            
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Booking List</div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration">
                                                <thead>
                                                <tr>
                                                    <th>Sr</th>
                                                    <th>Galileo Id</th>
                                                    <th>Customer</th>
                                                    <th>Phone No</th>
                                                    <th>Total Price</th>
                                                    <th>PNR</th>
                                                    <th>Status</th>
                                                    <th>Created at</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
    
                                                @if(count($bookings) > 0)
                                                    @foreach($bookings as $booking)
                                                    <tr>
                                                        <td>{{$loop->iteration}} </td>
                                                        <td>{{$booking->galileo_pnr}} </td>
                                                        <td>{{$booking->TravelersInfo[0]->first_name ?? '' }}&nbsp;{{$booking->TravelersInfo[0]->last_name ?? '' }} </td>
                                                        <td>{{$booking->Customercountry->phone_code ?? ''}} &nbsp;{{$booking->mobile}} </td>
                                                        <td>{{$booking->currency_code}}&nbsp; {{$booking->total_amount}} </td>
                                                        <td>{{$booking->pnr}} </td>
                                                        <td>{{str_replace("_"," ",$booking->booking_status) }}</td>
                                                        <td>{{$booking->created_at->format('d/m/Y')}} </td>
                                                        <td>
                                                            @if(!empty($booking->flight_ticket_path))
                                                            <a  href = "{{asset($booking->flight_ticket_path)}}" download data-bs-toggle="tooltip" title="Download Ticket"><i class="fa fa-download"></i></a> | 
                                                            @endif
                                                            @if(!empty($booking->invoice_path))
                                                            <a  href = "{{asset($booking->invoice_path)}}" download data-bs-toggle="tooltip" title="Download Invoice"><i class="fa fa-file-pdf-o"></i></a> | 
                                                            @endif
                                                            @can('booking-cancel')
                                                            @if($booking->ticket_status == 1 && ($booking->booking_status == "booking_completed" || $booking->booking_status == "cancellation_initiated") && $booking->is_cancel != 1)
                                                            <a  href = "javascript:"  onclick="cancle({{$booking->id}})" data-id="{{$booking->id}}"data-bs-toggle="tooltip" title="Cancle / Reschedule" data-toggle="modal" data-target="#cancleModel" id="canclebtn"><i class="fa fa-times-circle"></i></a>
                                                            @endif
                                                            @endcan
                                                        </td>
                                                       
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr align="center" class="alert alert-danger">
                                                        <td colspan="9">No Record(s)</td>
                                                    </tr>
                                                @endif
    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}


            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection