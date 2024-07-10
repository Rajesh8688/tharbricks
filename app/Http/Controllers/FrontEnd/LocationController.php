<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Location;
use App\Models\ServiceUser;
use Illuminate\Http\Request;
use App\Models\UserServiceLocation;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    //

    public function addLocation(Request $request){
        $this->validate($request, [
            'locationType' => 'required|in:nationwide,distance',
            'distance_value' => 'required_if:type,distance',
            // 'latitude' => 'required_if:type,distance',
            // 'longitude' => 'required_if:type,distance',
            'services' => 'required',
        ]);
     


        $userId = auth('web')->user()->id;

        $location = new Location();
        $location->type = $request->input('locationType');
        if($request->input('locationType') == 'distance'){
            $location->latitude = $request->input('latitude') ?? '44.968046';
            $location->longitude = $request->input('longitude') ?? '-93.232072';
            $location->pincode = '12345';
            $location->address = $request->input('address');
            $location->distance_value = $request->input('distance_value');
        }
        $location->user_id = $userId;
   
        $location->save();

        $serviceIds = $request->input('services');
        if(in_array('all_services' , $serviceIds)){
            $serviceIds = 'all_services';
        }
        if($serviceIds == 'all_services'){
            $serviceIds = ServiceUser::where(['user_id' => $userId , 'status' => 'Active'])->pluck('service_id')->toArray();
        }

        foreach($serviceIds as $key => $value){
            $serviceUser = ServiceUser::where(['user_id' => $userId , 'service_id' => $value , 'status' => 'Active'])->first();
            $userServiceLocation = new UserServiceLocation();
            $userServiceLocation->user_id = $userId;
            $userServiceLocation->service_id = $value;
            $userServiceLocation->location_id = $location->id;
            $userServiceLocation->service_user_id = $serviceUser->id;
            $userServiceLocation->status = 'Active';
            $userServiceLocation->save();
        }

        $myLocations = Location::where(["user_id" => auth('web')->user()->id])->OrderBy('id' , 'desc')->get();
        foreach($myLocations as $l=>$location){
            $locationservice = UserServiceLocation::where(['location_id' => $location->id , 'status' => "Active"])->get();
            $myLocations[$l]['services'] = $locationservice->count();
        }
        $response = ["status" =>true ,"message" => "Location Added Successfully" , 'locationCard' => view('front_end.ajax.locationCard',compact('myLocations'))->render()];
        return response($response, 200);
    }

    public function deleteLocation(Request $request){
        $locationId = $request->input('locationId');    
        $userId = auth('web')->user()->id;
        $location = Location::find($locationId);
        if($location === null || $location->user_id != $userId){
            return response()->json(['status' => false , "message" => 'Location Does not Exist' , 'data' => []], 500);
        }
        //deleting Location
        $location->delete();
        //deleting Location Service
        $locationService = UserServiceLocation::where(['location_id' => $locationId])->get();
        foreach($locationService as $key => $value){
            $value->delete();
        }
        $myLocations = Location::where(["user_id" => $userId])->OrderBy('id' , 'desc')->get();

        $showNationalwide = true;
        foreach($myLocations as $l=>$location){
            if($location->type == "nationwide"){
                $showNationalwide = false;
            }
            $locationservice = UserServiceLocation::where(['location_id' => $location->id , 'status' => "Active"])->get();
            $myLocations[$l]['services'] = $locationservice->count();
        }

        $response = ["status" =>true ,"message" => "Location Deleted Successfully" , 'locationCard' => view('front_end.ajax.locationCard',compact('myLocations'))->render() ,'showNationalwide'=>$showNationalwide];
        return response($response, 200);
    }

    public function getLocation(Request $request){
        $userId = auth('web')->user()->id;
        $locationId = $request->input('locationId');
        $myLocation = Location::where(["id" => $locationId , 'user_id' => $userId])->first();
        if($myLocation === null){
            return response()->json(['status' => false , "error" => 'Location Does not Exist' , 'data' => []], 500);
        }
        $myservices = ServiceUser::with('service')->where(['user_id' => $userId , 'status' => "Active"])->get();
        $UserServiceLocation = UserServiceLocation::select('service_id')->where(['location_id' => $locationId , 'status' => "Active"])->get();
        $taggedServiceIds = [];
        foreach($UserServiceLocation as $key => $value){
            $taggedServiceIds[] = $value->service_id;
        }
        $response = ["status" =>true ,"message" => "Location  Details" , 'updatePopup' => view('front_end.ajax.updateLocationPopup',compact('myLocation','myservices','UserServiceLocation','taggedServiceIds'))->render()];
        return response($response, 200);
    }

    public function updateLocation(Request $request){
        $this->validate($request, [
            'locationType' => 'required|in:nationwide,distance',
            'distance_value' => 'required_if:type,distance',
            // 'latitude' => 'required_if:type,distance',
            // 'longitude' => 'required_if:type,distance',
            'services' => 'required',
            'location_id' => 'required'
        ]);
     
        $userId = auth('web')->user()->id;
        $location = Location::where(["id" => $request->input('location_id') , 'user_id' => $userId])->first();
        if($location === null){
            return response()->json(['status' => false , "error" => 'Location Does not Exist' , 'data' => []], 500);
        }


        if($location->type == 'distance'){
            $location->latitude = $request->input('latitude') ?? '44.968046';
            $location->longitude = $request->input('longitude') ?? '-93.232072';
            $location->pincode = '12345';
            $location->address = $request->input('address');
            $location->distance_value = $request->input('distance_value');
        }
        $location->user_id = $userId;
   
        $location->save();

        $serviceIds = $request->input('services');
        if(in_array('all_services' , $serviceIds)){
            $serviceIds = 'all_services';
        }
        if($serviceIds == 'all_services'){
            $serviceIds = ServiceUser::where(['user_id' => $userId , 'status' => 'Active'])->pluck('service_id')->toArray();
        }
        UserServiceLocation::where(['location_id' => $request->input('location_id')])->whereNotIn('service_id' , $serviceIds)->delete();

        foreach($serviceIds as $key => $value){
            $userServiceLocation = UserServiceLocation::where(['user_id' => $userId , 'service_id' => $value  ,'location_id' =>$request->input('location_id')])->first();

            if($userServiceLocation === null){

                //insert
                $serviceUser = ServiceUser::where(['user_id' => $userId , 'service_id' => $value , 'status' => 'Active'])->first();
                $userServiceLocation = new UserServiceLocation();
                $userServiceLocation->user_id = $userId;
                $userServiceLocation->service_id = $value;
                $userServiceLocation->location_id = $request->input('location_id');
                $userServiceLocation->service_user_id = $serviceUser->id;
                $userServiceLocation->status = 'Active';
                $userServiceLocation->save();

            }else{
                //update
                $userServiceLocation->status = 'Active';
                $userServiceLocation->save();
            }
        }
        $myLocations = Location::where(["user_id" => auth('web')->user()->id])->OrderBy('id' , 'desc')->get();
        foreach($myLocations as $l=>$location){
            $locationservice = UserServiceLocation::where(['location_id' => $location->id , 'status' => "Active"])->get();
            $myLocations[$l]['services'] = $locationservice->count();
        }
        $response = ["status" =>true ,"message" => "Location updated Successfully" , 'locationCard' => view('front_end.ajax.locationCard',compact('myLocations'))->render()];
        return response($response, 200);

    }
}
