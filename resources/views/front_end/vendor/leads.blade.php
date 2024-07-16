@extends('front_end.vendor.layouts.master')
@section('content')
<style>
     .loexp-no-results-container {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    /* height: calc(50vh - 75px); */
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
    </style>

        {{-- <div class="card-body aon-card-body"> --}}
        <div class="">
            <div class="content-admin-main2">
                <div class="wt-admin-dashboard-msg-2">
                    <div class="col-12 col-lg-4 p-0 wt-dashboard-msg-user-list">
                        <!-- user msg list start-->
                        <div style="position: static;height: 77px;background-color: black;color: white;display: flex;">
                            <div style="padding: 11px 16px;"> 
                                <div>{{$information['totalAvaiableLeads']}} {{__('lang.matching_leads')}}</div>
                                <div style="font-size: small;"> {{$information['userServices']}}  {{__('lang.services')}} &nbsp; <span><i class="fa fa-map-marker"></i> &nbsp;1 {{__('lang.locations')}}</span></div>
                            </div>
                            <div style="text-align: end;flex: 1;padding: 14px 22px;"> 
                                <a href="javascript:void(0);" class="site-button">
                                    <i class="fa fa-edit"></i> {{__('lang.edit')}}
                                 </a>
                            </div>
                        </div>
                        <div id="msg-list-wrap" class="wt-dashboard-msg-search-list">
                            @forelse ($leads as $item)
                            <div class="wt-dashboard-msg-search-list-wrap" onclick="leadDetails({{$item->id}})">
                                <a href="javascript:;" class="msg-user-info clearfix" style="padding: 15px 10px 15px 20px ">
                                    <div class="msg-user-info-text">
                                        <div><div class="msg-user-name"><b>{{ucfirst($item->name)}}</b></div> <div class="msg-user-timing badge badge-success" style="color: #fff;"> {{$item->lead_added_on}}</div></div>
                                        <div class="msg-user-name">{{$item->service->name}}</div>
                                        <div class="msg-user-discription"><i class="aon-input-icon fa fa-map-marker"></i> {{$item->address}}</div>
                                        <div class="msg-user-discription">{{$item->leadAnswersShort}} </div>
                                        <div >
                                            <div class=" msg-user-discription">26 {{__('lang.credits')}} <span style="position: absolute;right: 10px;font-size: 12px;color: #2d7af1;">Be the <span class="font-weight-bold">1st to respond</span> </span></div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            @empty
                            {{-- <div class="wt-dashboard-msg-search-list-wrap" >
                                <a href="javascript:;" class="msg-user-info clearfix" style="padding: 15px 10px 15px 20px ">
                                    <div class="msg-user-info-text">
                                        <div><div class="msg-user-name"><b>fdgfdgdfgdgg</b></div> <div class="msg-user-timing badge badge-success" style="color: #fff;"> dsfds</div></div>
                                        
                                    </div>
                                </a>
                            </div> --}}
                            <div class="loexp-no-results-container">
                                <div class="card-block pt-5">
                                    <img class="img-fluid" width="156" height="111" src="https://d18jakcjgoan9.cloudfront.net/s/img/frontend-v2/seller-dashboard/noresults-illustration.png!d=PVEswj" srcset="https://d18jakcjgoan9.cloudfront.net/s/img/frontend-v2/seller-dashboard/noresults-illustration.png!d=PVEswj 1x, https://d18jakcjgoan9.cloudfront.net/s/img/frontend-v2/seller-dashboard/noresults-illustration.png!d=KAYSPp 2x">
                                    <h4 class="mt-2">
                                        No Lead
                                    </h4>
                                    <p class="text-center mt-2 text-light-grey">{{__('lang.you_havent_responded_to_any_customers_yet_When_you_do_youll_be_able_to_contact_and_access_their_details_here')}}.</p>
                                    <a href="/sellers/dashboard/">{{__('lang.view_leads')}}</a>
                                </div>
                            </div>
                                
                            @endforelse
                                                                                                                           
                        </div>
                        <!-- user msg list End-->
                        
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
                                        <h3>{{$lead->name}} </h3>
                                        <div class="sf-provi-cat"><strong>{{__('lang.service')}}:</strong> {{$lead->service->name}}</div>
                                        <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-map-marker"></i> &nbsp; {{$lead->address}}</div>
                                        <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-phone"></i> &nbsp; {{$lead->encrypted_phone}}</div>
                                        <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-envelope"></i> &nbsp; {{$lead->encrypted_email}}</div>
                                        <div class="sf-provi-bio-text">
                                            <div class="sf-provi-btn" style="padding-bottom: 20px">
                                                <a href="{{route('vendor-interested-lead',['lead_id'=>$lead->id])}}" class="site-button">
                                                    <i class="fa fa-briefcase"></i>{{__('lang.contact')}} 
                                                </a>
                                                <a href="{{route('vendor-not-interested-lead',['lead_id'=>$lead->id])}}" style="padding-left: 35px;">
                                                    {{__('lang.not_interested')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Q A-->
                                    <div class="sf-provi-amqudo-box margin-b-50 sf-provi-fullBox">
                                        <div class="sf-custom-tabs sf-custom-new">
                                            <ul class="nav nav-tabs nav-table-cell font-20">
                                            <li><a data-toggle="tab" href="#tab-11111" class="active">{{__('lang.details')}}</a></li>
                                            </ul>
                                            <div class="tab-content">
                                            <div id="tab-11111" class="tab-pane active">
                                                <ul>
                                                    
                                                    @foreach ($lead->leadAnswers as $q=>$leadAnswer)
                                                    {{-- <li> --}}
                                                        <h5 class="sf-qestion-line nav-active">{{ucfirst($leadAnswer->question->question_text) ?? ''}} </h5>
                                                        <div class="sf-answer-line" style="display:block; padding-bottom: 10px;">{{ucfirst($leadAnswer->answer_text) }}</div>
                                                    {{-- </li> --}}
                                                        
                                                    @endforeach
                                                   
                                                    
                                                    <ul>
                                           
                                            </div>
                                          
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                           
                                    <div class="loexp-no-results-container">
                                        <div class="card-block pt-5">
                                            <img class="img-fluid" width="156" height="111" src="https://d18jakcjgoan9.cloudfront.net/s/img/frontend-v2/seller-dashboard/noresults-illustration.png!d=PVEswj" srcset="https://d18jakcjgoan9.cloudfront.net/s/img/frontend-v2/seller-dashboard/noresults-illustration.png!d=PVEswj 1x, https://d18jakcjgoan9.cloudfront.net/s/img/frontend-v2/seller-dashboard/noresults-illustration.png!d=KAYSPp 2x">
                                            <h4 class="mt-2">
                                                No Lead
                                            </h4>
                                            <p class="text-center mt-2 text-light-grey">{{__('lang.you_havent_responded_to_any_customers_yet_When_you_do_youll_be_able_to_contact_and_access_their_details_here')}}.</p>
                                            {{-- <a href="/sellers/dashboard/">View leads</a> --}}
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
    url = "{{route('vendor-lead-details')}}";
    
    function leadDetails(id){
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
    @if(session('success'))
        toastr.success('{{session('success')}}', 'success');
    @endif
    @if(session('error'))
        toastr.error('{{session('error')}}', 'error');
    @endif
    </script>
@endsection