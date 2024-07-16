<div id="activity-log-container" class="">
    <div id="activity-log-items-container">
        @foreach ($responseActivitys as $k=>$activity)
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
                                {{__('lang.you')}}
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