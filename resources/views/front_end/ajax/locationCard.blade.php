
<div class="">
    <div class="row aon-avi-time-slot">
        @foreach ($myLocations as $location)
        <div class="col-lg-3 col-md-4">
            <div class="sf-avai-time-slots-wrap">
                <div class="pl-2">
                    @if($location->type == "distance")
                    <p>Within <b>{{$location->distance_value}} kms</b> of <b>{{$location->address}}</b></p>
                    @else
                    <p><b>{{ucfirst($location->type)}}</b> </p>
                    @endif
                    <p class="" style="color: gray;opacity: 0.7;font-weight: 500;">{{$location->services}} service</p>
                </div>
                <div class="sf-avai-time-slots-control" style="justify-content: center">
                    <div class="sf-avai-time-slots-btn">
                        <button type="button" class="btn slot-delete  has-toltip" title="Delete" onClick="deleteLocation({{$location->id}})">
                            <i class="fa fa-remove"> &nbsp; Delete</i>
                            <span class="header-toltip">Delete</span>
                        </button>
                        </div>
                    
                    <div class="sf-avai-time-slots-btn">
                        <button type="button" class="btn slot-update has-toltip" title="Update" onClick="getLocation({{$location->id}})">
                            <i class="fa fa-refresh">&nbsp; Update</i>
                            <span class="header-toltip">Update</span>
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
            <button type="button"  class="site-button"  style="margin-right: 10px;margin-bottom: 26px;"> Cancle </button>
            <button class="site-button" data-toggle="modal" data-target="#addLocation" type="button">
                <i class="fa fa-plus"></i>
                Add Location
            </button>
        </div>
    </div> 
</div>