
<div class="">
    <div class="row aon-avi-time-slot">
        @foreach ($myLocations as $location)
        <div class="col-lg-3 col-md-4">
            <div class="sf-avai-time-slots-wrap">
                <div class="pl-2">
                    @if($location->type == "distance")
                    <p>{{__('lang.within')}} <b>{{$location->distance_value}} kms</b> {{__('lang.of')}} <b>{{$location->address}}</b></p>
                    @else
                    <p><b>{{ucfirst($location->type)}}</b> </p>
                    @endif
                    <p class="" style="color: gray;opacity: 0.7;font-weight: 500;">{{$location->services}} {{__('lang.service')}}</p>
                </div>
                <div class="sf-avai-time-slots-control" style="justify-content: center">
                    <div class="sf-avai-time-slots-btn">
                        <button type="button" class="btn slot-delete  has-toltip" title="{{__('lang.delete')}}" onClick="deleteLocation({{$location->id}})">
                            <i class="fa fa-remove"> &nbsp; {{__('lang.delete')}}</i>
                            <span class="header-toltip">{{__('lang.delete')}}</span>
                        </button>
                        </div>
                    
                    <div class="sf-avai-time-slots-btn">
                        <button type="button" class="btn slot-update has-toltip" title="{{__('lang.update')}}" onClick="getLocation({{$location->id}})">
                            <i class="fa fa-refresh">&nbsp; {{__('lang.update')}}</i>
                            <span class="header-toltip">{{__('lang.update')}}</span>
                        </button>
                    </div>

                </div>

            </div>
        </div>
        @endforeach
        
        {{-- <center>No Locations Found</center> --}}
    </div>
    <div class ="col-12" > 
        <hr>
        <div  style="float:right">
            <button type="button"  class="site-button"  style="margin-right: 10px;margin-bottom: 26px;"> {{__('lang.cancle')}} </button>
            <button class="site-button" data-toggle="modal" data-target="#addLocation" type="button">
                <i class="fa fa-plus"></i>
                {{__('lang.add_location')}}
            </button>
        </div>
    </div> 
</div>