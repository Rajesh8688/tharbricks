@extends('front_end.vendor.layouts.master')
@section('content')
<style>
     .loexp-no-results-container {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    height: calc(50vh - 75px);
    /* background: #f9f9fa; */
}
.loexp-no-results-container .card-block {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    min-width: 0;
    top: 25%;
    width: 50%;
}
.mCustomScrollBox{
    height: inherit !important;
    /* overflow: visible !important; */
    /* align-items: center;
    display: flex */
}
.wt-dashboard-msg-user-list{
    /* display: inline-block !important; */
}

.wt-admin-dashboard-msg-2{
    display: flex !important;
}
.response-status-label {
    margin-left: auto;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    border: 1px solid transparent;
    background: #f3f3f6;
    border-radius: 12px;
    padding: 2px 10px;
}
.latest-action{
    display: flex;
    background-color: #f3f3f6!important;
    border-radius: 4px!important;

}
.tharbrick-icon{
    width: 1.25em;
    height: 1.25em;
}
.time-posted{
    margin-top: 0;
    margin-left: auto;
    margin-top: 0.2em;
    white-space: nowrap;
}
.alert-tharbricks{
    color: #721c24;
    background-color: #f3f3f6;
    border-color: #f3f3f6;
}
.text-light-grey {
    color: #9da0b6!important;
}
.text-sm {
    font-size: 1.0em;
}

.text-grey-400 {
    color: #9da0b6!important;
}
.text-grey-600 {
    color: #6c7191!important;
}
#activity-log-container .activity-log-date-item .left-track .line.top, #activity-log-container .activity-log-item .left-track .line.top {
    height: 1em;
}

#activity-log-container .activity-log-date-item .left-track .line, #activity-log-container .activity-log-item .left-track .line {
    border-left: 1px solid #e6e7ec;
    width: 1px;
}
#activity-log-container .activity-log-date-item .left-track .line.top, #activity-log-container .activity-log-item .left-track .line.top {
    height: 1em;
}
#activity-log-container .activity-log-date-item .left-track .line, #activity-log-container .activity-log-item .left-track .line {
    border-left: 1px solid #e6e7ec;
    width: 1px;
}
#activity-log-container .activity-log-date-item:last-of-type .line.bottom, #activity-log-container .activity-log-item:last-of-type .line.bottom {
    border-color: transparent!important;
}
#activity-log-container .activity-log-date-item .left-track .line, #activity-log-container .activity-log-item .left-track .line {
    border-left: 1px solid #e6e7ec;
    width: 1px;
}
.flex-fill {
    flex: 1 1 auto!important;
}
#activity-log-container .activity-log-date-item.first .line.full, #activity-log-container .activity-log-date-item.first .line.top, #activity-log-container .activity-log-item.first .line.full, #activity-log-container .activity-log-item.first .line.top {
    border-color: transparent!important;
}
#activity-log-container .activity-log-date-item .item-icon .icon-border, #activity-log-container .activity-log-item .item-icon .icon-border {
    border-color: none!important;
    width: 40px;
    height: 40px;
}
#activity-log-container .activity-log-date-item .item-icon .icon-border img, #activity-log-container .activity-log-item .item-icon .icon-border img {
    width: 24px;
    height: 24px;
}
#call-feedback-modal .modal-body {
    padding: 1.75em 2em 1.5em;
}
.text-overflow-ellipsis {
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.text-xl {
    font-size: 1.25em;
}
.align-items-center {
    align-items: center!important;
}
#call-feedback-modal .header-section {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
#call-feedback-modal .copy-link-container {
    position: relative;
}
.ml-1, .mx-1 {
    margin-left: 0.25em!important;
}
#call-feedback-modal .btns-title {
    font-size: .875em;
    /* font-family: gorditaregular; */
}
#call-feedback-modal .response-btns-container button {
    padding: 1em;
}
.bg-grey-200 {
    background-color: #ced0da!important;
}

/* styles leftbar */
.seller-dash-v2 .all-projects-header {
    background-color: #fff;
    border-bottom: 1px solid #f3f3f6;
}
.text-xs {
    font-size: .875em;
}
#responses-container .response-status-tabs-container {
    background-color: #111637;
}


.pl-xl-5, .px-xl-5 {
    padding-left: 3em!important;
}
.no-gutters>.col, .no-gutters>[class*=col-] {
    padding-right: 0;
    padding-left: 0;
}
#responses-container .response-status-tabs-container .response-status-tabs {
    display: flex;
}
#responses-container .response-status-tabs-container .response-status-tabs .tab-block.active {
    background: #fff;
    box-shadow: none;
}
#responses-container .response-status-tabs-container .response-status-tabs .tab-block {
    border: 1px solid transparent;
    background: #f3f3f6;
    box-shadow: inset 0 -1px 6px rgba(0,0,0,.15);
    border-radius: 4px 4px 0 0;
    width: 45%;
    height: 42px;
    padding: 1em;
    margin-right: 0.5em;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: flex-start;
}
.bark-svg-icon svg {
    display: block;
    width: 100%;
    height: 100%;
}
#responses-container .response-status-tabs-container .view-all-link {
    color: #6c7191;
    text-decoration: none;
}
.text-xs {
    font-size: .875em;
}
.text-light-grey {
    color: #9da0b6!important;
}

.sticky-top {
    position: sticky;
    top: 0;
    z-index: 1020;
}


    </style>
        {{-- <div class="card-body aon-card-body"> --}}
            <div class="">
            <div class="content-admin-main2">
                <div class="wt-admin-dashboard-msg-2">
                    <div class="col-12 col-lg-4 p-0 wt-dashboard-msg-user-list">
                        <!-- user msg list start-->
                        <div style="position: static;height: 77px;background-color: black;color: white;display: flex;">
                            <div style="padding: 11px 16px;"> 
                                <div>{{$information['totalMyleads']}} matching Leads</div>
                                <div style="font-size: small;"> {{$information['totalMyservices']}}  services &nbsp; <span><i class="fa fa-map-marker"></i> &nbsp;1 location</span></div>
                            </div>
                            <div style="text-align: end;flex: 1;padding: 14px 22px;"> 
                                <a href="javascript:void(0);" class="site-button">
                                    <i class="fa fa-edit"></i> Edit
                                 </a>
                            </div>
                        </div>
                        {{-- <div class="all-projects-header sticky-top text-xs" id="items-header">
    

                            <div class="row no-gutters px-4 pl-xl-5 pt-2 response-status-tabs-container">
                                <div class="col-9">
                                    <div class="response-status-tabs">
                                        <div id="response-live" class="tab-block active">
                                            
                                            <span>Pending</span>
                                        </div>
                                        <div id="response-hired" class="tab-block">
                                           
                                            <span>Hired</span>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-3 d-flex align-items-center justify-content-end">
                                    <a id="response-view-all" href="#" class="view-all-link">View all</a>
                                </div>
                            </div>
                        
                           <div class="row no-gutters px-4 pl-xl-5  js-enquiries-switch d-none border-bottom">
                                <div class="col-9 my-auto">
                                    <div class="d-flex">
                                        <div class="toggle-icon enquiries-branded d-none"><span class="bark-svg-icon mr-2"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="20" height="20" rx="4" fill="#F7BF53"></rect>
                                        <path d="M14.25 14.3752H5.75C5.54375 14.3752 5.375 14.5392 5.375 14.7397V15.4689C5.375 15.6694 5.54375 15.8335 5.75 15.8335H14.25C14.4563 15.8335 14.625 15.6694 14.625 15.4689V14.7397C14.625 14.5392 14.4563 14.3752 14.25 14.3752ZM16.375 6.25016C15.7539 6.25016 15.25 6.74007 15.25 7.34391C15.25 7.5057 15.2875 7.65609 15.3531 7.79508L13.6562 8.78402C13.2953 8.99365 12.8289 8.87516 12.6203 8.51969L10.7102 5.27034C10.9609 5.06982 11.125 4.76904 11.125 4.42725C11.125 3.8234 10.6211 3.3335 10 3.3335C9.37891 3.3335 8.875 3.8234 8.875 4.42725C8.875 4.76904 9.03906 5.06982 9.28984 5.27034L7.37969 8.51969C7.17109 8.87516 6.70234 8.99365 6.34375 8.78402L4.64922 7.79508C4.7125 7.65837 4.75234 7.5057 4.75234 7.34391C4.75234 6.74007 4.24844 6.25016 3.62734 6.25016C3.00625 6.25016 2.5 6.74007 2.5 7.34391C2.5 7.94775 3.00391 8.43766 3.625 8.43766C3.68594 8.43766 3.74688 8.42855 3.80547 8.41943L5.5 12.8127H14.5L16.1945 8.41943C16.2531 8.42855 16.3141 8.43766 16.375 8.43766C16.9961 8.43766 17.5 7.94775 17.5 7.34391C17.5 6.74007 16.9961 6.25016 16.375 6.25016Z" fill="#111637"></path>
                                        </svg>
                                        </span></div>
                                        <div class="toggle-icon enquiries-branded-greyed d-none"><span class="bark-svg-icon mr-2">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="20" height="20" rx="4" fill="#CED0DA"></rect>
                                                <path d="M14.25 14.3752H5.75C5.54375 14.3752 5.375 14.5392 5.375 14.7397V15.4689C5.375 15.6694 5.54375 15.8335 5.75 15.8335H14.25C14.4563 15.8335 14.625 15.6694 14.625 15.4689V14.7397C14.625 14.5392 14.4563 14.3752 14.25 14.3752ZM16.375 6.25016C15.7539 6.25016 15.25 6.74007 15.25 7.34391C15.25 7.5057 15.2875 7.65609 15.3531 7.79508L13.6562 8.78402C13.2953 8.99365 12.8289 8.87516 12.6203 8.51969L10.7102 5.27034C10.9609 5.06982 11.125 4.76904 11.125 4.42725C11.125 3.8234 10.6211 3.3335 10 3.3335C9.37891 3.3335 8.875 3.8234 8.875 4.42725C8.875 4.76904 9.03906 5.06982 9.28984 5.27034L7.37969 8.51969C7.17109 8.87516 6.70234 8.99365 6.34375 8.78402L4.64922 7.79508C4.7125 7.65837 4.75234 7.5057 4.75234 7.34391C4.75234 6.74007 4.24844 6.25016 3.62734 6.25016C3.00625 6.25016 2.5 6.74007 2.5 7.34391C2.5 7.94775 3.00391 8.43766 3.625 8.43766C3.68594 8.43766 3.74688 8.42855 3.80547 8.41943L5.5 12.8127H14.5L16.1945 8.41943C16.2531 8.42855 16.3141 8.43766 16.375 8.43766C16.9961 8.43766 17.5 7.94775 17.5 7.34391C17.5 6.74007 16.9961 6.25016 16.375 6.25016Z" fill="white"></path>
                                                </svg>
                                                </span></div>
                                        <span class="text-regular">Receive enquiries</span>
                                    </div>
                                </div>
                                <div class="col-3 my-auto h-100">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="pr-3 my-auto ">
                                            <span>
                                                <a class="enquiries-edit" href="/settings/enquiries/profiles/view"> Edit</a>
                                            </span>
                                        </div>
                                        <div class="my-auto ">
                                        <div class="custom-control custom-switch pointer">
                                          <input type="checkbox" class="custom-control-input enquiries-toggle" checked="" data-toggle="toggle" id="enquiries-toggle">
                                          <label class="custom-control-label" for="enquiries-toggle">
                                            <div class="enquiries-icon"></div>
                                          </label>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        
                            <div class="row no-gutters px-4 pl-xl-5 py-3 results-count">
                                <div class="col-6">
                                    <div class="results-count-filter">
                                        144 pending responses
                                    </div>
                                    <div class="last-updated text-light-grey text-xs d-none d-lg-block">
                                        
                                        <p class="mb-0">Updated <span class="since-value">6m ago</span>
                                        
                                        <a href="#" class="refresh-link">Refresh</a></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex filter-mobile filter-icon-wrapper justify-content-end fresh-filter-row">
                                        
                                        <span class="bark-svg-icon bsi-primary-primary"><!--?xml version="1.0" encoding="UTF-8"?-->
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>filter</title>
                                            <desc>Created with Sketch.</desc>
                                            <g id="filter" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="baseline-filter_list-24px">
                                                    <polygon id="Path" points="0 0 24 0 24 24 0 24"></polygon>
                                                    <path d="M10,18 L14,18 L14,16 L10,16 L10,18 Z M3,6 L3,8 L21,8 L21,6 L3,6 Z M6,13 L18,13 L18,11 L6,11 L6,13 Z" id="Shape" class="primary-color" fill-rule="nonzero"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        </span>
                                        
                                        <a href="#" class="filter-mobile link pl-2 open-filters-link">
                                            Filter
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                        </div> --}}

                        <div id="msg-list-wrap" class="wt-dashboard-msg-search-list">
                            @forelse ($myleads as $item)
                            <div class="wt-dashboard-msg-search-list-wrap" onclick="responseDetails({{$item->id}})">
                                <a href="javascript:;" class="msg-user-info clearfix" style="padding: 15px 10px 15px 20px ">
                                    <div class="msg-user-info-text">
                                        <div>
                                            <div class="msg-user-name"><b>{{ucfirst($item->name)}}</b></div> 
                                            <div class="msg-user-timing response-status-label" style="color: black;"> {{$item->response_status}}</div>
                                        </div>
                                        <div class="msg-user-name">{{$item->service_name}}</div>
                                        <div class="msg-user-discription"><i class="aon-input-icon fa fa-map-marker"></i> {{$item->address}}</div>
                                        <div class="msg-user-discription py-2">{{$item->leadAnswersShort}} </div>
                                        {{-- <div >
                                            <div class=" msg-user-discription">26 credits <span style="position: absolute;right: 10px;font-size: 12px;color: #2d7af1;">Be the <span class="font-weight-bold">1st to respond</span> </span></div>
                                        </div> --}}
                                        <div class="mt-2 px-2 py-2 bg-grey-50 flex-row latest-action justify-content-between align-items-center text-break text-xs rounded">
                                            <div class="pr-2">
                                                <span class="tharbrick-icon bsi-primary-grey-600 bsi-sm">
                                                    <i class="fa fa-check"></i>
                                                </span>                                
                                            </div>
                                            <div class="pr-2 ">
                                                {{$item->lastActivityMessage}}
                                            </div>
                                            <div class="time-posted text-grey-400">{{Carbon\Carbon::parse($item->lastActivityDate)->diffForHumans(null,null,true)}}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            @empty
                            <div class="wt-dashboard-msg-search-list-wrap" >
                                <a href="javascript:;" class="msg-user-info clearfix" style="padding: 15px 10px 15px 20px ">
                                    <div class="msg-user-info-text">
                                        <div><div class="msg-user-name"><b>No Pending Leads</b></div> 
                                        {{-- <div class="msg-user-timing badge badge-success" style="color: #fff;"> dsfds</div> --}}
                                    </div>
                                        
                                    </div>
                                </a>
                            </div>
                                
                            @endforelse
                                                                                                                           
                        </div>
                       
                        
                    </div>
                    
                    <div class="col-12 col-lg-8 p-0 wt-dashboard-msg-box">
                      
                        <div id="msg-chat-wrap" class="single-user-msg-conversation ">

                            <div id = "leadDetails">
                                @if($lead)
                                <div class="container">
                                    <div class="sf-provi-bio-box cleafix margin-b-50 ">
                                        <br>
                                        @if(session('error-alert'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                             {{session('error-alert')}}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                            </button>
                                          </div>
                                        @endif  
                                        <div class="alert  alert-tharbricks fade show" role="alert" >
                                            Last activity {{Carbon\Carbon::parse($lead->lastActivityDate)->diffForHumans(null,null,true)}}
                                        </div>
                                        <div class="d-flex flew-row flex-wrap justify-content-between align-items-center pb-2">
                                            <div class="project-name-location pr-3 pt-2">
                                                <h4 class="mb-0"><span class="buyer_name">{{ucfirst($lead->name)}}</span></h4>
                                            </div>
                                            <div class="responded-ago text-xs-14 text-light-grey pt-2">
                                                <b>Responded {{Carbon\Carbon::parse($lead->lastActivityDate)->diffForHumans(null,null,true)}}</b>
                                            </div>
                                        </div>
                                        <div class="sf-provi-cat"><strong>{{$lead->service->name}}</strong> | {{$lead->address}} </div>
                                  
                                        <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-phone"></i> &nbsp; <a ref="#"  data-toggle="modal" data-target="#call-feedback-modal" >Show Number</a></div>
                                        <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-envelope"></i> &nbsp; {{$lead->email}}</div>
                                        <div class="">
                                            <div class="sf-provi-btn" style="padding-bottom: 20px">
                                                <a href="#" class="site-button" data-toggle="modal" data-target="#call-feedback-modal" >
                                                    <i class="fa fa-phone"></i>Show Number <i class="fa fa-external-link "></i>
                                                </a>
                                                <a href={{"https://wa.me/$lead->phone"}} class="site-button" target = "_blank">
                                                    <i class="fa fa-whatsapp"></i>Send WhatsApp </i>
                                                </a>
                                                <a href={{"mailto:$lead->email"}} class="site-button">
                                                    <i class="fa fa-envelope"></i>Send Email 
                                                </a>
                                                <a href="{{route('vendor-interested-lead',['lead_id'=>$lead->id])}}" class="site-button">
                                                    <i class="fa fa-comments"></i>Send SMS 
                                                </a>
                                            </div>
                                        </div>
                                        <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-tag"></i> &nbsp; Your estimate : <a href="#" data-toggle="modal" data-target="#add_estimation"> send an estimate</a></div>
                               
                                    </div>
                                    <!--Q A-->
                                    <div class="sf-provi-amqudo-box margin-b-50 sf-provi-fullBox">
                                        <div class="sf-custom-tabs sf-custom-new">
                                            <ul class="nav nav-tabs nav-table-cell font-20">
                                                <li><a data-toggle="tab" href="#tab-11111" class="active">Activity</a></li>
                                                <li><a data-toggle="tab" href="#tab-22222" >Lead Details</a></li>
                                                <li><a data-toggle="tab" href="#tab-33333" >My Notes</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="tab-11111" class="tab-pane active">
                                                    <div id="activity-log">
                                                        <div id="activity-log-container" class="">
                                                            <div id="activity-log-items-container">
                                                                @foreach ($lead->responseActivities as $k=>$activity)
                                                                    <div class="activity-log-item d-flex justify-content-between @if($k==0) first @endif">
                                                                        <div class="left-track flex-grow-0 d-flex flex-column align-items-center">
                                                                            <div class="line top"></div>
                                                                            <div class="item-icon item-icon-project_purchased_alt">
                                                                                <div class="icon-border border rounded-circle d-flex justify-content-center align-items-center" style="background-color:#F3F3F6">
                                                                                    @if($activity->from == 'vendor')
                                                                                    <img class="" src="{{asset('frontEnd/images/transperent-favion-24.png')}}" alt="">
                                                                                    @else
                                                                                    <img class="" src="{{asset('frontEnd/images/looking_for.svg')}}" alt="">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="line bottom flex-fill"></div>
                                                                        </div>
                                                                        <div class="details flex-column flex-grow-1 ml-2 mb-4 p-3 border text-sm card" style="border-radius: 10px;font-weight: bold;">
                                                                            <div class="details-top d-flex justify-content-between text-sm text-grey-400">
                                                                                <div class="details-top-left flex-grow-1">
                                                                                    <div class="item-actor-name">
                                                                                        @if($activity->from == 'vendor')
                                                                                        You
                                                                                        @else
                                                                                        {{ucfirst($lead->name)}}
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <div class="details-top-right">
                                                                                    <div class="item-date">
                                                                                        {{ Carbon\Carbon::parse($activity->logged_date)->format('d M H:i') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <p class="item-message mb-0 mt-1">{{$activity->message}}</p>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                @endforeach
                                                               
                                                                
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="tab-22222" class="tab-pane ">
                                                    <ul>
                                                        @foreach ($lead->leadAnswers as $q=>$leadAnswer)
                                                            <h5 class="sf-qestion-line nav-active">{{ucfirst($leadAnswer->question->question_text) ?? ''}} </h5>
                                                            <div class="sf-answer-line" style="display:block; padding-bottom: 10px;">{{ucfirst($leadAnswer->answer_text) }}</div>
                                                        @endforeach
                                                    <ul>
                                                </div>
                                                <div id="tab-33333" class="tab-pane ">
                                                    <div class="widget widget_tag_cloud ">                   
                                                        <div class="tagcloud">
                                                            <a >sdfjgsdf hgkhsgfhfssdufiysdhfiu </a>
                                                        </div>
                                                    </div>
                                                    <div class="editer-wrap">
                                                        <div class="editer-textarea">
                                                            <textarea class="form-control" rows="6" placeholder="Write a private Notes" id ="notes" name = "notes"></textarea>
                                                        </div>
                                                    </div>
                                                    <div style="float:right;padding-top:20px">
                                                        <button type="button"  class="site-button" >Cancel </button>
                                                        <button type="button"  class="site-button" >Update </button>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade content-admin-main" id="call-feedback-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body" id="call-feedback-modal-container">
                                                <div class="header-section">
                                                        <h1 class="text-xl text-center text-overflow-ellipsis">Call Janes</h1>
                                                        <div class="buyer-number-container d-flex justify-content-center align-items-center">
                                                            <a href="tel:+918147547067" class="d-flex justify-content-center align-items-center">
                                                                <span class="bark-svg-icon bsi-primary-primary mr-1 bsi-sm flex-shrink-0"><i calss="aon-input-icon fa fa-phone"></i> </span> 
                                                                <span class="text-xl">{{$lead->phone}}</span>
                                                            </a>
                                                        </div>
                                                </div>
                                                <h2 class="btns-title text-center mt-2 mb-3">Update your progress</h2>
                                                <div class="d-flex justify-content-center align-items-center response-btns-container">
                                                    <div class="text-center d-flex justify-content-center align-items-center flex-column">
                                                        <button class="btn bg-danger mb-2 js-cfb-no-answer-btn" onclick="updateActivityLogger('no_answer' ,{{$lead->id}})"> <span class="bark-svg-icon bsi-primary-white ">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_51_7502)">
                                                                <path d="M23.7051 16.8C20.6551 13.91 16.5351 12.13 11.9951 12.13C7.45512 12.13 3.33512 13.91 0.285117 16.8C0.105117 16.98 -0.00488281 17.23 -0.00488281 17.51C-0.00488281 17.79 0.105117 18.04 0.285117 18.22L2.76512 20.7C2.94512 20.88 3.19512 20.99 3.47512 20.99C3.74512 20.99 3.99512 20.88 4.17512 20.71C4.96512 19.97 5.86512 19.35 6.83512 18.86C7.16512 18.7 7.39512 18.36 7.39512 17.96V14.86C8.84512 14.38 10.3951 14.13 11.9951 14.13C13.5951 14.13 15.1451 14.38 16.5951 14.85V17.95C16.5951 18.34 16.8251 18.69 17.1551 18.85C18.1351 19.34 19.0251 19.97 19.8251 20.7C20.0051 20.88 20.2551 20.98 20.5251 20.98C20.8051 20.98 21.0551 20.87 21.2351 20.69L23.7151 18.21C23.8951 18.03 24.0051 17.78 24.0051 17.5C24.0051 17.22 23.8851 16.98 23.7051 16.8ZM5.39512 17.36C4.73512 17.73 4.10512 18.16 3.52512 18.63L2.45512 17.56C3.36512 16.81 4.35512 16.17 5.40512 15.66V17.36H5.39512ZM20.4751 18.62C19.8751 18.14 19.2551 17.72 18.5951 17.35V15.65C19.6451 16.16 20.6251 16.8 21.5451 17.55L20.4751 18.62ZM6.99512 6.56001L11.9351 11.5L19.0051 4.43001L17.5951 3.01001L11.9351 8.67001L8.39512 5.13001H10.9951V3.13001H4.99512V9.13001H6.99512V6.56001Z" fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_51_7502">
                                                                        <rect width="24" height="24" fill="white"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg></span> 
                                                        </button>
                                                        <span class="regular-text text-xs text-danger">No<br>answer</span>
                                                    </div>
                                                    <div class="text-center d-flex justify-content-center align-items-center flex-column mx-3">
                                                        <button class="btn bg-grey-200 mb-2 js-cfb-left-voicemail-btn"> <span class="bark-svg-icon bsi-primary-white ">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M18.5 6.5C15.46 6.5 13 8.96 13 12C13 13.33 13.47 14.55 14.26 15.5H9.74C10.53 14.55 11 13.33 11 12C11 8.96 8.54 6.5 5.5 6.5C2.46 6.5 0 8.96 0 12C0 15.04 2.46 17.5 5.5 17.5H18.5C21.54 17.5 24 15.04 24 12C24 8.96 21.54 6.5 18.5 6.5ZM5.5 15.5C3.57 15.5 2 13.93 2 12C2 10.07 3.57 8.5 5.5 8.5C7.43 8.5 9 10.07 9 12C9 13.93 7.43 15.5 5.5 15.5ZM18.5 15.5C16.57 15.5 15 13.93 15 12C15 10.07 16.57 8.5 18.5 8.5C20.43 8.5 22 10.07 22 12C22 13.93 20.43 15.5 18.5 15.5Z" fill="white"></path>
                                                            </svg></span> 
                                                        </button>
                                                        <span class="regular-text text-xs text-grey-600">Left<br>voicemail</span>
                                                    </div>
                                                    <div class="text-center d-flex justify-content-center align-items-center flex-column">
                                                        <button class="btn bg-success mb-2 js-cfb-we-talked-btn"> <span class="bark-svg-icon bsi-primary-white ">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M20 15.7251C18.76 15.7251 17.55 15.5251 16.43 15.1551C16.33 15.1151 16.22 15.1051 16.12 15.1051C15.86 15.1051 15.61 15.2051 15.41 15.3951L13.21 17.5951C10.38 16.1451 8.06 13.8351 6.62 11.0051L8.82 8.80509C9.1 8.52509 9.18 8.13509 9.07 7.78509C8.7 6.66509 8.5 5.46509 8.5 4.21509C8.5 3.66509 8.05 3.21509 7.5 3.21509H4C3.45 3.21509 3 3.66509 3 4.21509C3 13.6051 10.61 21.2151 20 21.2151C20.55 21.2151 21 20.7651 21 20.2151V16.7251C21 16.1751 20.55 15.7251 20 15.7251ZM5.03 5.21509H6.53C6.6 6.10509 6.75 6.97509 6.99 7.80509L5.79 9.00509C5.38 7.80509 5.12 6.53509 5.03 5.21509ZM19 19.1851C17.68 19.0951 16.41 18.8351 15.2 18.4351L16.39 17.2451C17.24 17.4851 18.11 17.6351 18.99 17.6951V19.1851H19Z" fill="white"></path>
                                                                <path d="M16 11.42L12 7.42L13.41 6.01L16 8.59L20.59 4L22 5.42L16 11.42Z" fill="white"></path>
                                                                </svg></span> 
                                                            </button>
                                                        <span class="regular-text text-xs text-success">We<br>talked</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn text-grey-400 js-cfb-dismiss-btn regular-text text-xs">Didn’t call</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                           
                                    <div class="loexp-no-results-container">
                                        <div class="card-block">
                                            <img class="img-fluid" width="156" height="111" src="{{asset('frontEnd/images/no-response.png')}}" >
                                            <h4 class="mt-2">
                                                No responses
                                            </h4>
                                            <p class="text-center mt-2 text-light-grey">You haven’t responded to any customers yet. When you do, you’ll be able to contact and access their details here.</p>
                                            <a href="{{route('vendor-leads')}}">View leads</a>
                                        </div>
                                    </div>
                             
                                @endif
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade content-admin-main" id="add_estimation" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog model-w800" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Add Estimation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="estimationForm" enctype="multipart/form-data">
                            @csrf
                            <div class="sf-md-padding">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Estimation Text</label>
                                            <textarea class="form-control" rows="5" name="estimationText" id="estimationText"></textarea>
                                            <div id="estimationTexterror" style="display: none"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Estimation</label><br>
                                            <input type="file" name="estimationattachment" id="estimationattachment">
                                            <div id="estimationattachmentError" style="display: none"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="lead_user_id" value="{{$lead->lead_user_id}}">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="admin-button" data-dismiss="modal">Cancel</button>
                        <button type="button" class="admin-button" onclick="sendEstimationfun()">Add</button>
                    </div>
                </div>
            </div>
        </div>
        
        
@endsection
@section('extraScripts')
<script>
    url = "{{route('vendor-response-lead-details')}}";
    loggerUrl = "{{route('vendor-activity-logger')}}";
    sendEstimation = "{{route('vendor-estimation')}}";
    
    function responseDetails(id){
        $.ajax({
            type: 'get',
            url: url,
            data: {
            'lead_id' : id
            },
            beforeSend: function () { 
              //$(".loading-area").show();
            },
            success: function (response) {
                $("#leadDetails").html(response.leadDetails);
                
            },
            complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                // $("#serachpnrfromsubmit").prop('disabled',false);
                // $("#serachpnrfromsubmit").find('span').html( '' );
                //$(".loading-area").hide();
                },
            error:function(response){
                console.log(response);
            }
        });

    }
    function updateActivityLogger(message,lead_id){
        $.ajax({
            type: 'GET',
            url: loggerUrl,
            data: {'lead_id' : lead_id,'message' : message},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (response) {
                $("#activity-log").html(response.ajaxActivityLogger);
            },
            error:function(response){
                console.log(response);
            }
        });
    }

    function sendEstimationfun() {
        var isValid = true;

        var estimationText = $("#estimationText").val();
        if (estimationText == undefined || estimationText == '' || estimationText == null) {
            $("#estimationTexterror").css('display', 'block').css('color', 'red').html('Please enter Text');
            isValid = false;
        } else {
            $("#estimationTexterror").css('display', 'none');
        }

        if ($('#estimationattachment').get(0).files.length === 0) {
            $("#estimationattachmentError").css('display', 'block').css('color', 'red').html('Please select attachment');
            isValid = false;
        } else {
            $("#estimationattachmentError").css('display', 'none');
        }
        if (isValid) {
            var formData = new FormData($('#estimationForm')[0]);
            $.ajax({
                type: 'POST',
                url: sendEstimation, // Ensure this URL matches your route
                data: formData,
                contentType: false,
                processData: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    console.log(response);
                    // Handle the response
                    console.log('Success:', response);
                    $("#activity-log").html(response.ajaxActivityLogger);
                    $('#estimationForm')[0].reset(); // Reset the form
                    $('#add_estimation').modal('hide'); // Hide the modal
                },
                error: function (response) {
                    console.log('Error:', response);
                    $('#upload-result').html('<p>Error: ' + response.responseJSON.error + '</p>');
                }
            });
        }
    }
    // Reset form when modal is hidden
    $('#add_estimation').on('hidden.bs.modal', function () {
        $('#estimationForm')[0].reset();
        $("#estimationTexterror").css('display', 'none');
        $("#estimationattachmentError").css('display', 'none');
    });

    @if(session('success'))
        toastr.success('{{session('success')}}', 'success');
    @endif
    @if(session('error'))
        toastr.error('{{session('error')}}', 'error');
    @endif
    </script>
@endsection