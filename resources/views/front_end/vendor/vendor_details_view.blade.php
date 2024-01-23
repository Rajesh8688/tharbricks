@if($lead)
<div class="container">
    <div class="sf-provi-bio-box cleafix margin-b-50 ">
        <br>
        <h3>{{$lead->name}} </h3>
        <div class="sf-provi-cat"><strong>Category:</strong> {{$lead->category->name}}</div>
        <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-map-marker"></i> &nbsp; {{$lead->address}}</div>
        <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-phone"></i> &nbsp; {{$lead->encrypted_phone}}</div>
        <div class="sf-provi-cat"> <i class="aon-input-icon fa fa-envelope"></i> &nbsp; {{$lead->encrypted_email}}</div>
        <div class="sf-provi-bio-text">
            <div class="sf-provi-btn" style="padding-bottom: 20px">
                <a href="javascript:void(0);" class="site-button">
                    <i class="fa fa-briefcase"></i>Contact 
                </a>
                <a href="javascript:void(0);" style="padding-left: 35px;">
                    Not interested
                </a>
            </div>
        </div>
    </div>
    <!--Q A-->
    <div class="sf-provi-amqudo-box margin-b-50 sf-provi-fullBox">
        <div class="sf-custom-tabs sf-custom-new">
            <ul class="nav nav-tabs nav-table-cell font-20">
                <li><a data-toggle="tab" href="#tab-11111" class="active">Details</a></li>
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
   <!--No Lead-->
@endif