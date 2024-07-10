@extends('front_end.vendor.layouts.master')
@section('content')
<style>
    .dropdown-menu {
            border-radius: 20px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/response.css')}}">
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
                                        {{-- <div class="alert  alert-tharbricks fade show" role="alert" >
                                            Last activity {{Carbon\Carbon::parse($lead->lastActivityDate)->diffForHumans(null,null,true)}}
                                        </div> --}}
                                        <div class="alert alert-tharbricks fade show" role="alert">
                                            Last activity {{Carbon\Carbon::parse($lead->lastActivityDate)->diffForHumans(null,null,true)}}
                                            <div class="dropdown d-inline">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ucfirst($lead->response_status)}}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#" onclick="UpdateResponse({{$lead->id}} , 'Pending')">Pending</a>
                                                    <a class="dropdown-item" href="#" onclick="UpdateResponse({{$lead->id}} , 'Hired')">Hired</a>
                                                    <a class="dropdown-item" href="#" onclick="UpdateResponse({{$lead->id}} , 'Archived')">Archived</a>
                                                </div>
                                            </div>
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
                                                <a class="site-button"  href="#" onclick="updateActivityLogger('send_whats_app' ,{{$lead->id}})">
                                                    <i class="fa fa-whatsapp"></i>Send WhatsApp </i>
                                                </a>
                                                <a  class="site-button" href="#" onclick="updateActivityLogger('send_email' ,{{$lead->id}})">
                                                    <i class="fa fa-envelope"></i>Send Email 
                                                </a>
                                                {{-- <a href="{{route('vendor-interested-lead',['lead_id'=>$lead->id])}}" class="site-button">
                                                    <i class="fa fa-comments"></i>Send SMS 
                                                </a> --}}
                                            </div>
                                        </div>
                                        <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-tag"></i> &nbsp; Your estimate : <a href="#" data-toggle="modal" data-target="#add_estimation"> send an estimate</a></div>
                                        @if($lead->reviewLink != "dontShow")
                                            @if($lead->reviewLink == "reviewSubmited")
                                            <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-star"></i> &nbsp; Rating :
                                                <div class="sf-customer-rating-star">
                                                    <div class="sf-ow-pro-rating">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star text-gray"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-star"></i> &nbsp; Request Review : 
                                                @if($lead->reviewLink == "send")
                                                <a onclick="requestReview({{$lead->id}})" > send review link</a>
                                                @elseif($lead->reviewLink == "resend")
                                                <a  onclick="requestReview({{$lead->id}})" > re-send review link</a>
                                                @endif
                                            </div>
                                            @endif
                                        @endif
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
                                                    <div id ='activitynotes'>
                                                        <div class="widget_tag_cloud ">                   
                                                            <div class="tagcloud">
                                                                @foreach ($lead->notes as $note)
                                                                    <a>{{$note->notes}}</a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <form id="notesForm">
                                                        <div class="editer-wrap">
                                                            <div class="editer-textarea">
                                                                <textarea class="form-control" rows="6" placeholder="Write a private Notes" id ="notes" name = "notes"></textarea>
                                                                <div id ="noteserror"></div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="lead_user_id" value="{{$lead->lead_user_id}}">
                                                        <div style="float:right;padding-top:20px">
                                                            <button type="button"  class="site-button" onclick="addnotesfun()">Add </button>
                                                        </div> 
                                                    </form>
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
                                                        <h1 class="text-xl text-center text-overflow-ellipsis">Call {{$lead->name}}</h1>
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
                                                        <button class="btn bg-grey-200 mb-2 js-cfb-left-voicemail-btn" onclick="updateActivityLogger('left_voice_mail' ,{{$lead->id}})"> <span class="bark-svg-icon bsi-primary-white ">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M18.5 6.5C15.46 6.5 13 8.96 13 12C13 13.33 13.47 14.55 14.26 15.5H9.74C10.53 14.55 11 13.33 11 12C11 8.96 8.54 6.5 5.5 6.5C2.46 6.5 0 8.96 0 12C0 15.04 2.46 17.5 5.5 17.5H18.5C21.54 17.5 24 15.04 24 12C24 8.96 21.54 6.5 18.5 6.5ZM5.5 15.5C3.57 15.5 2 13.93 2 12C2 10.07 3.57 8.5 5.5 8.5C7.43 8.5 9 10.07 9 12C9 13.93 7.43 15.5 5.5 15.5ZM18.5 15.5C16.57 15.5 15 13.93 15 12C15 10.07 16.57 8.5 18.5 8.5C20.43 8.5 22 10.07 22 12C22 13.93 20.43 15.5 18.5 15.5Z" fill="white"></path>
                                                            </svg></span> 
                                                        </button>
                                                        <span class="regular-text text-xs text-grey-600">Left<br>voicemail</span>
                                                    </div>
                                                    <div class="text-center d-flex justify-content-center align-items-center flex-column">
                                                        <button class="btn bg-success mb-2 js-cfb-we-talked-btn" onclick="updateActivityLogger('we_talked' ,{{$lead->id}})"> <span class="bark-svg-icon bsi-primary-white ">
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
                                                <button type="button" class="btn text-grey-400 js-cfb-dismiss-btn regular-text text-xs" onclick="updateActivityLogger('didnt_call' ,{{$lead->id}})">Didn’t call</button>
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
    
@endsection
@section('extraScripts')
<script>
    url = "{{route('vendor-response-lead-details')}}";
    loggerUrl = "{{route('vendor-activity-logger')}}";
    sendEstimation = "{{route('vendor-estimation')}}";
    addnotes = "{{route('vendor-notes')}}";
    updateResponseUrl = "{{route('updateResponse')}}";
    requestReviewUrl = "{{route('vendor-requestReview')}}";
    
    
    function responseDetails(id){
        $.ajax({
            type: 'get',
            url: url,
            data: {
            'lead_id' : id
            },
            success: function (response) {
                $("#leadDetails").html(response.leadDetails);
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
                    toastr.success(response.message, 'success');
                },
                error: function (response) {
                    toastr.error(response.message, 'error');
                }
            });
        }
    }

    function addnotesfun(){
        var isValid = true;

        var notes = $("#notes").val();
        if (notes == undefined || notes == '' || notes == null) {
            $("#noteserror").css('display', 'block').css('color', 'red').html('Please enter Notes');
            isValid = false;
        } else {
            $("#noteserror").css('display', 'none');
        }

        
        if (isValid) {
            var formData = new FormData($('#notesForm')[0]);
            $.ajax({
                type: 'POST',
                url: addnotes, // Ensure this URL matches your route
                data: formData,
                contentType: false,
                processData: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    console.log(response);
                    // Handle the response
                    console.log('Success:', response);
                    $("#activity-log").html(response.ajaxActivityLogger);
                    $("#activitynotes").html(response.ajaxnotes);
                    $('#notesForm')[0].reset(); // Reset the form
                    toastr.success(response.message, 'success');
                },
                error: function (response) {
                    toastr.error(response.message, 'error');
                }
            });
        }
    }

    function updateActivityLogger(message,lead_id){
        $.ajax({
            type: 'GET',
            url: loggerUrl,
            data: {'lead_id' : lead_id,'message' : message},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (response) {
                $("#leadDetails").html(response.responseDetails);
               
                if(response.openwhatsapp){
                    window.open("https://wa.me/"+response.whatsappNumber, "_blank");
                }
                if(response.openemail){
                    window.open("mailto:"+response.email, "_blank");
                }
                toastr.success(response.message, 'success');
                $(".modal-backdrop").remove()
            },
            error:function(response){
                console.log(response);
                toastr.error(response.message, 'error');
            }
        });
    }

    function requestReview(LeadId){
        $.ajax({
            type: 'POST',
            url: requestReviewUrl,
            data: {'lead_id' : LeadId},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (response) {
                $("#leadDetails").html(response.responseDetails);
                var phoneNumber = "+91"+response.number;  //Replace with the recipient's phone number in international format
                var message = 'Hello, Please Submit your Review: '+response.link;
                // Encode the message
                var encodedMessage = encodeURIComponent(message);
                // Construct the WhatsApp URL
                var whatsappUrl = 'https://wa.me/' + phoneNumber + '/?text=' + encodedMessage;
                // Open the WhatsApp URL
                window.open(whatsappUrl, '_blank');
                toastr.success(response.message, 'success');
            },
            error:function(response){
                console.log(response);
                toastr.error(response.message, 'error');
            }
        });
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