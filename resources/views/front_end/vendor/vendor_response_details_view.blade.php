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
                {{__('lang.last_activity')}} {{Carbon\Carbon::parse($lead->lastActivityDate)->diffForHumans(null,null,true)}}
            </div>
            <div class="d-flex flew-row flex-wrap justify-content-between align-items-center pb-2">
                <div class="project-name-location pr-3 pt-2">
                    <h4 class="mb-0"><span class="buyer_name">{{ucfirst($lead->name)}}</span></h4>
                </div>
                <div class="responded-ago text-xs-14 text-light-grey pt-2">
                    <b>{{__('lang.responded')}} {{Carbon\Carbon::parse($lead->lastActivityDate)->diffForHumans(null,null,true)}}</b>
                </div>
            </div>
            <div class="sf-provi-cat"><strong>{{$lead->service->name}}</strong> | {{$lead->address}} </div>
        
            <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-phone"></i> &nbsp; <a ref="#"  data-toggle="modal" data-target="#call-feedback-modal" >{{__('lang.show_number')}}</a></div>
            <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-envelope"></i> &nbsp; {{$lead->email}}</div>
            <div class="">
                <div class="sf-provi-btn" style="padding-bottom: 20px">
                    <a href="#" class="site-button" data-toggle="modal" data-target="#call-feedback-modal" >
                        <i class="fa fa-phone"></i>{{__('lang.show_number')}} <i class="fa fa-external-link "></i>
                    </a>
                    <a href={{"https://wa.me/$lead->phone"}} class="site-button" target = "_blank">
                        <i class="fa fa-whatsapp"></i>{{__('lang.send_whatsapp')}} </i>
                    </a>
                    <a href={{"mailto:$lead->email"}} class="site-button">
                        <i class="fa fa-envelope"></i>{{__('lang.send_email')}}
                    </a>
                    {{-- <a href="{{route('vendor-interested-lead',['lead_id'=>$lead->id])}}" class="site-button">
                        <i class="fa fa-comments"></i>Send SMS 
                    </a> --}}
                </div>
            </div>
            <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-tag"></i> &nbsp; {{__('lang.your_estimate')}} : <a href="#" target="_blank"> {{__('lang.send_an_estimate')}}</a></div>
    
        </div>
        <!--Q A-->
        <div class="sf-provi-amqudo-box margin-b-50 sf-provi-fullBox">
            <div class="sf-custom-tabs sf-custom-new">
                <ul class="nav nav-tabs nav-table-cell font-20">
                    <li><a data-toggle="tab" href="#tab-11111" class="active">{{__('lang.activity')}}</a></li>
                    <li><a data-toggle="tab" href="#tab-22222" >{{__('lang.lead_details')}}</a></li>
                    <li><a data-toggle="tab" href="#tab-33333" >{{__('lang.my_notes')}}</a></li>
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
                                    {{-- <div class="activity-log-item d-flex justify-content-between first">
                                        <div class="left-track flex-grow-0 d-flex flex-column align-items-center">
                                            <div class="line top"></div>
                                            <div class="item-icon item-icon-project_purchased_alt">
                                                <div class="icon-border border rounded-circle d-flex justify-content-center align-items-center" style="">
                                                    <img class="" src="{{asset('frontEnd/images/transperent-favion-24.png')}}" alt="">
                                                </div>
                                            </div>
                                            <div class="line bottom flex-fill"></div>
                                        </div>
                                        <div class="details flex-column flex-grow-1 ml-2 mb-4 p-3 border text-sm card" style="border-radius: 10px;font-weight: bold;">
                                            <div class="details-top d-flex justify-content-between text-sm text-grey-400">
                                                <div class="details-top-left flex-grow-1">
                                                    <div class="item-actor-name">You</div>
                                                </div>
                                                <div class="details-top-right">
                                                    <div class="item-date">19:50</div>
                                                </div>
                                            </div>
                                            <p class="item-message mb-0 mt-1">Purchased the lead</p>
                                        </div>
                                    </div>
                                    
                                
                                    
                                    <div class="activity-log-item d-flex justify-content-between" >
                                        <div class="left-track flex-grow-0 d-flex flex-column align-items-center">
                                            <div class="line top"></div>
                                            <div class="item-icon item-icon-project_released">
                                                <div class="icon-border border rounded-circle d-flex justify-content-center align-items-center" style="background-color:#F3F3F6">
                                                    <img class="" src="{{asset('frontEnd/images/looking_for.svg')}}" alt="">
                                                </div>
                                            </div>
                                            <div class="line bottom flex-fill"></div>
                                        </div>
                                        <div class="details flex-column flex-grow-1 ml-2 mb-4 p-3 border text-sm card" style="border-radius: 10px;font-weight: bold;">
                                            <div class="details-top d-flex justify-content-between text-sm text-grey-400">
                                                <div class="details-top-left flex-grow-1">
                                                    <div class="item-actor-name">Janes</div>
                                                </div>
                                                <div class="details-top-right">
                                                    <div class="item-date">19:46</div>
                                                </div>
                                            </div>
                                            <div class="details-center">
                                                <p class="item-message mb-0 mt-1">Looking for a Building Contractor</p>
                                            </div>
                                                <hr>
                                            <div class="details-bottom">
                                                <div class="item-content text-grey-600">
                                                    <p class="mb-0"><a data-toggle="tab" href="#tab-22222" class="show-project-details" >View details</a></p>
                                                    <a href="#" class="show-more-link mt-3">Show more</a>
                                                    <a href="#" class="show-less-link mt-3">Show less</a>
                                                </div>
                                            </div> 
                                        </div>
                                    </div> --}}
                                    
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
                        <div class="editer-wrap">
                            <div class="editer-textarea">
                                <textarea class="form-control" rows="6" placeholder="Write a private Notes"></textarea>
                            </div>
                        </div>
                        <div style="float:right;padding-top:20px">
                            <button type="button"  class="site-button" >{{__('lang.cancle')}} </button>
                            <button type="button"  class="site-button" >{{__('lang.update')}} </button>
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
                            <button class="btn bg-danger mb-2 js-cfb-no-answer-btn"> <span class="bark-svg-icon bsi-primary-white ">
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