<div class="modal fade content-admin-main" id="updateLocationpopup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog model-w800" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel2">Update New Location</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="updatelocationform">
            <div class="modal-body">
                <div class="sf-md-padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Choose how you want to set your location</label>
                                <div class="aon-inputicon-box"> 
                                    <div class="radio-inline-box">
                                        <div class="checkbox sf-radio-checkbox sf-radio-check-2"  id ="locationNationalWide">
                                            <input id="loc1" name="locationType" value="nationwide" type="radio" readonly @if($myLocation->type == "nationwide") checked @endif>
                                            <label for="loc1">Nationwide</label>
                                        </div>
                          
                                        <div class="checkbox sf-radio-checkbox sf-radio-check-2">
                                            <input id="loc2" name="locationType" value="distance" type="radio" readonly @if($myLocation->type == "distance") checked @endif>
                                            <label for="loc2">Distance</label>
                                        </div>
                                    </div>
                                    <div class="error-message" id="locationTypeError">Please select a location type.</div>
                                </div>
                            </div>
                        </div>
                        @if($myLocation->type == "distance")
                        <div style=" padding: 0px 20px">
                            <div class="row">
                                <div class="col-md-8"> 
                                    <div class="form-group">
                                        <label>Pin Code / City</label>
                                        <div class="aon-inputicon-box"> 
                                            <input class="form-control sf-form-control" name="address" id="address" type="text" placeholder="PinCode/City" value="{{$myLocation->address}}">
                                            <i class="aon-input-icon fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Distance</label>
                                        <select class="sf-select-box form-control sf-form-control form-control" name="distance_value" id="distance_value" data-live-search="true" title="Distance">
                                            <option value="1" @if($myLocation->distance_value == 1) selected @endif>1 Km</option>
                                            <option value="2" @if($myLocation->distance_value == 2) selected @endif>2 Kms</option>
                                            <option value="5" @if($myLocation->distance_value == 5) selected @endif>5 Kms</option>
                                            <option value="10" @if($myLocation->distance_value == 10) selected @endif>10 Kms</option>
                                            <option value="20" @if($myLocation->distance_value == 20) selected @endif>20 Kms</option>
                                            <option value="30" @if($myLocation->distance_value == 30) selected @endif>30 Kms</option>
                                            <option value="50" @if($myLocation->distance_value == 50) selected @endif>50 Kms</option>
                                            <option value="75" @if($myLocation->distance_value == 75) selected @endif>75 Kms</option>
                                            <option value="100" @if($myLocation->distance_value == 100) selected @endif>100 Kms</option>
                                            <option value="125" @if($myLocation->distance_value == 125) selected @endif>125 Kms</option>
                                            <option value="150" @if($myLocation->distance_value == 150) selected @endif>150 Kms</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <input type="hidden" name="location_id"  value="{{$myLocation->id}}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Services</label>
                                <div class="aon-inputicon-box"> 
                                    <div class="radio-inline-box">
                                        @foreach($myservices as $UserService)
                                            <div class="checkbox sf-radio-checkbox sf-radio-check-2">
                                                <input id="updateLol{{$UserService->service->id}}" name="services[]" value="{{$UserService->service->id}}" type="checkbox" required @if(in_array($UserService->service->id,$taggedServiceIds)) checked @endif>
                                                <label for="updateLol{{$UserService->service->id}}">{{ ucfirst($UserService->service->name) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="error-message" id="servicesError">Please select at least one service.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @csrf
    
            <div class="modal-footer">
                <button type="button" class="site-button" data-dismiss="modal">Cancel</button>
                <button type="button" class="site-button" id="addButton" onclick="updateLocation()">Update</button>
            </div>
        </form>
      </div>
    </div>
</div>