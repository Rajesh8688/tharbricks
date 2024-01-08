@extends('admin.layouts.master')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row match-height ">
                    <!-- Description lists horizontal -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Categories</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="card-text">
                                        <dl class="row">
                                            <dt class="col-sm-7 col-7"> Total </dt>
                                            <dd class="col-sm-5 col-5"> : &nbsp; {{$dashboardDetails['categoryCount']}} </dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-7 col-7"> Active </dt>
                                            <dd class="col-sm-5 col-5"> : &nbsp; {{$dashboardDetails['categoryActiveCount']}} </dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-7 col-7"> InActive :</dt>
                                            <dd class="col-sm-5 col-5"> : &nbsp; {{$dashboardDetails['categoryInActiveCount']}} </dd>
                                        </dl>
                                       

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Description lists horizontal-->
                    <!-- Description lists horizontal -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Vendors  </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="card-text">
                                        <dl class="row">
                                            <dt class="col-sm-7 col-7">Total </dt>
                                            <dd class="col-sm-5 col-5"> : &nbsp; 0 </dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-7 col-7">Active </dt>
                                            <dd class="col-sm-5 col-5"> : &nbsp;  0 </dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-7 col-7">InActive </dt>
                                            <dd class="col-sm-5 col-5"> : &nbsp; 0 </dd>
                                        </dl>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Description lists horizontal-->
                    <!-- Description lists horizontal -->
                    {{-- <div class="col-sm-12 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{__('lang.total_sales')}} </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="card-text">
                                        <dl class="row">
                                            <dt class="col-sm-5 col-5">{{__('lang.total')}} :</dt>
                                            <dd class="col-sm-7 col-7"> {{$dashboardDetails['totalSales']}} </dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-5 col-5">{{__('lang.web')}} :</dt>
                                            <dd class="col-sm-7 col-7"> {{$dashboardDetails['websales']}} </dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-5 col-5">{{__('lang.app')}} :</dt>
                                            <dd class="col-sm-7 col-7"> {{$dashboardDetails['appsales']}} </dd>
                                        </dl>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--/ Description lists horizontal-->
                    <!-- Description lists horizontal -->
                    {{-- <div class="col-sm-12 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> {{__('lang.total_statistics')}} </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="card-text">
                                        <dl class="row">
                                            <dt class="col-sm-7 col-4"> {{__('lang.customers')}} :</dt>
                                            <dd class="col-sm-5 col-8"> {{$dashboardDetails['totalCustomers']}} </dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-7 col-4">{{__('lang.booking')}} :</dt>
                                            <dd class="col-sm-5 col-8"> {{$dashboardDetails['totalBookings']}} </dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-sm-7 col-4">{{__('lang.sales')}} :</dt>
                                            <dd class="col-sm-5 col-8"> {{$dashboardDetails['totalSales']}} </dd>
                                        </dl>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--/ Description lists horizontal-->

                   
                </div>
                @can('booking-view')
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card">
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

                                            @if(count($dashboardDetails['bookings']) > 0)
                                                @foreach($dashboardDetails['bookings'] as $booking)
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
                @endcan
               
            </section>
            <!-- Dashboard Analytics end -->

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
@section('extrascript')
    <script>


        @if(session('success'))
        toastr.success('{{session('success')}}', 'Success');
        @endif
        @if(session('error'))
        toastr.error('{{session('error')}}', 'Error');
        @endif


    </script>
@endsection