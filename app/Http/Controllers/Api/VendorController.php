<?php

namespace App\Http\Controllers\Api;

use App\Models\Lead;
use App\Models\Plan;
use App\Models\User;
use Razorpay\Api\Api;
use App\Models\Review;
use App\Models\Service;
use App\Models\LeadUser;
use App\Models\Location;
use App\Models\ServiceUser;
use App\Models\VendorImage;
use Illuminate\Http\Request;
use App\Models\RazorPayOrder;
use App\Models\VendorDetails;
use App\Models\RazorPayOrders;
use Illuminate\Validation\Rule;
use App\Models\ReviewLeadChecker;
use Illuminate\Support\Facades\DB;
use App\Models\UserServiceLocation;
use App\Http\Controllers\Controller;
use App\Models\CreditTransactionLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class VendorController extends BaseApiController
{
    public function deleteAccount(Request $request){
        //delete User
        $user = User::find(auth('api')->user()->id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully' , 'status' => true]);
    }
    public function UserProfile(Request $request){
        $info = $this->profileInfo(auth('api')->user()->id);
        return response()->json($info);
    }

    public function UpdateProfile(Request $request){

        $validator = Validator::make($request->all(), [
            'email' =>  'email|unique:users,email,'.auth('api')->user()->id, // 'users' is the table name, and 'email' is the column 
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }

        $userTableUpdate = ['name' , 'first_name' , 'last_name' , 'mobile' , 'address', 'email' , 'description'];

        $vendorTableUpdate = ['company_name' , 'company_description' , 'company_size' ,'website' , 'facebook_url' , 'twitter_url' , 'youtube_url' , 'alter_mobile' , 'company_address' ,'years_in_business','linked_in_url','pinterest_url','instagram_url' ,'is_new_reviews_on_profile_push_notifications','is_new_leads_i_receive_push_notifications','is_customers_sending_me_a_message_push_notifications','is_new_lead_i_receive_email_notifications','is_customers_closing_leads_ive_responded_email_notifications','is_customers_dismissing_my_response_email_notifications','is_customers_hiring_me_email_notifications','is_customers_reading_a_message_i_sent_email_notifications','is_customers_requesting_a_call_form_me_email_notifications','is_customers_requesting_me_to_contact_them_email_notifications','is_customers_viewing_my_profile_email_notifications','is_customers_viewing_my_website_email_notifications','is_a_summary_of_leads_im_matched_to_each_day_email_notifications','is_customers_sending_me_a_message_email_notifications','is_new_reviews_on_my_profile_email_notifications','is_new_reviews_from_other_sources_email_notifications','company_email' ,'company_phone','what_do_you_love_most_about_your_job','what_inspired_you_to_start_your_own_business','why_should_our_clients_choose_you','can_you_provide_your_service_online_or_remotely','what_changes_have_made_to_keep_customers_safe_from_covid19','how_long_have_you_been_in_business','what_guarantee_does_your_work_comes_with'];

        $user = User::find(auth('api')->user()->id);
        $vendorInfo =  VendorDetails::where("user_id" , $user->id)->first();

        foreach($request->input() as $rk => $requestSingleInput)
        {
            if(in_array($rk , $userTableUpdate)){
                $user->$rk = $requestSingleInput;
            }
            if(in_array($rk , $vendorTableUpdate)){
                $vendorInfo->$rk = $requestSingleInput;
            }
        }
        $user->update(); 
        $vendorInfo->update(); 
        $info = $this->profileInfo(auth('api')->user()->id);
        if($info['status']){
            $info['message'] = 'User Information updated successfully';
        }
        return response()->json($info);


    }

    public function transactionLogs(Request $request){
        //function for getting transation logs
        $user = User::find(auth('api')->user()->id);
        $transactionLogs = CreditTransactionLog::where("user_id" , $user->id)->orderBy("id","desc")->get();
        $response = ['data' => $transactionLogs,"status"=>true ,"message" => "user Transation Logs"];
        return response($response, 200);
    }

    public function userService($userId){
        $services = ServiceUser::leftJoin('services', function($join) {
            $join->on('services.id', '=', 'service_users.service_id');
        })
        ->addSelect('services.*', 'service_users.id as service_user_id')
        ->where(['service_users.status'=> 'Active' , 'service_users.user_id'=> $userId])
        ->get();
        foreach($services as $s=>$service){
            $services[$s]['service_location'] = UserServiceLocation::with('location')->where(['service_user_id' => $service->service_user_id ,'status' => 'Active'])->get();
        }
        return $services;
    }
    
    public function myServices(){
        //function for getting My Services
        $userid = auth('api')->user()->id;
        $services = $this->userService($userid);
        $response = ['data' => $services,"status"=>true ,"message" => "user services"];
        return response($response, 200);
    }

    public function addService(Request $request){
        $validator = Validator::make($request->all(), [
            'service_ids' =>  'required', // 'users' is the table name, and 'email' is the column 
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }

        $userId = auth('api')->user()->id;
        $serviceIds = $request->input('service_ids');
        $serviceIds = explode("," , $serviceIds);
        foreach($serviceIds as $serviceId){
            $serviceUser = ServiceUser::where(['user_id'=>$userId , 'service_id' => $serviceId])->first();
            if ($serviceUser === null) {
                //insert
                $userservice = new ServiceUser();
                $userservice->user_id =  $userId ;
                $userservice->service_id = $serviceId;
                $userservice->save();
                $services = $this->userService($userId);
            }else{
                //update
                $serviceUser->status = "Active";
                $serviceUser->save();
                $services = $this->userService($userId);
            }
        }
        $response = ["status" =>true ,"message" => "Service added successfully" ,'data' => $services];
        return response($response, 200);
    }

    public function editService(Request $request){
        $validator = Validator::make($request->all(), [
            'location_ids' =>  'required',
            'service_id' =>  'required'
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }

        $userId = auth('api')->user()->id;
        $locationIds = explode("," , $request->input('location_ids'));
        $serviceId = $request->input('service_id');
        //deleting unwanted user Service Location 
        UserServiceLocation::where(['service_id' => $request->input('service_id')])->whereNotIn('location_id' , $locationIds)->delete();
        foreach($locationIds as $locationId){
            $userLocation = UserServiceLocation::where(['service_id' => $serviceId , 'location_id' => $locationId])->first();
            if($userLocation === null){
                $serviceUser = ServiceUser::where(['service_id' => $serviceId , 'user_id' => $userId])->first();
                $userLocation = new UserServiceLocation();
                $userLocation->service_id = $serviceId;
                $userLocation->location_id = $locationId;
                $userLocation->user_id = $userId;
                $userLocation->service_user_id = $serviceUser->id;
                $userLocation->save();
            }
        }
        $services = $this->userService($userId);
        $response = ["status" =>true ,"message" => "Service Location Updated Successfully" ,'data' => $services];
        return response($response, 200);
    }

    public function removeService(Request $request){
        $validator = Validator::make($request->all(), [
            'service_id' =>  'required', // 'users' is the table name, and 'email' is the column 
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }

        $userId = auth('api')->user()->id;
        $serviceId = $request->input('service_id');

        $serviceUser = ServiceUser::where(['user_id'=>$userId , 'service_id' => $serviceId])->first();
        if($serviceUser === null){
            
            $response = ["status" =>false ,"message" => "Service Not Tagged to this user" ,'data' => []];
            return response($response, 200);
        }else{
            ServiceUser::where(['user_id'=>$userId , 'service_id' => $serviceId])->update(['status'=>'InActive']);
            $services = $this->userService($userId);
            $response = ["status" =>true ,"message" => "Service Removed Successfully" ,'data' => $services];
            return response($response, 200);
        }
    }

    public function changePassword(Request $request)
    {
        // dd(auth()->user());
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => ['required', 'string', 'min:8', 'confirmed','regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/' ],
        ],[
            'new_password.regex' => 'password must contain at least one lowercase letter,at least one uppercase letter ,at least one digit,at least one special charactor',
        ]);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => false,
        //         "message" => $validator->errors(),
        //     ], 200);
        // }
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }
        

        if (!(Hash::check($request->get('current_password'), auth()->user()->password))) {
            $response = ["status" =>false ,"message" => "Your current password does not matches with the password." ];
            return response($response, 200);
        }

        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            // Current password and new password same

            $response = ["status" =>false ,"message" => "New Password cannot be same as your current password." ];
            return response($response, 200);
        }

        $user = User::where("id",auth()->user()->id)->update([
        'password' =>  Hash::make($request->input('new_password'))]);

        $response = ["status" =>true ,"message" => "Password updated successfully"];
        return response($response, 200);
      
    }

    public function uploadImage(Request $request)
    {
        $strLang = app()->getLocale();

        $rules = [
            'type' => 'required|in:profile_image,company_logo,company_gallery',
            'image' => 'required',
        ];
        $valid = Validator::make($request->all(), $rules);
        $errorMessages = $valid->messages()->all();

        if ($valid->fails()) {
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0],
                'link' => ''
            ], 200);
        }

        $userId = auth('api')->user()->id;
        
        $image = $request->image;
        $id = '';

        if ($userId) {
            if($request->type == 'profile_image'){
                $originalPath = User::$imagePath;
                if(!empty(auth('api')->user()->profile_pic)){
                    // Delete the previous image
                    deleteImage($originalPath, auth('api')->user()->profile_pic);
                }
                $uploadImage = base64imageUpload($image , $originalPath);
                if($uploadImage['status']){
                    $userdetails = User::find( auth('api')->user()->id);
                    $userdetails->profile_pic = $uploadImage['filename'];
                    $userdetails->save();
                }
            }elseif($request->type == 'company_logo'){
                $vendorDetails =  VendorDetails::where("user_id" , auth()->user()->id)->first();
                $originalPath = User::$imageCompanyUrl;
                if(!empty($vendorDetails->company_logo))
                {
                    // Delete the previous image
                    deleteImage(User::$imageCompanyUrl, $vendorDetails->company_logo);
                }
                $uploadImage = base64imageUpload($image , $originalPath);
                if($uploadImage['status']){
                    $vendorDetails->company_logo = $uploadImage['filename'];
                    $vendorDetails->save();
                }
            }elseif($request->type == 'company_gallery'){
                //gallery
                $originalPath = User::$imageCompanyUrl;
                $uploadImage = base64imageUpload($image , $originalPath);
                if($uploadImage['status']){
                    $vendorImage = new VendorImage();
                    $vendorImage->user_id = $userId;
                    $vendorImage->image = $uploadImage['filename'];
                    $vendorImage->status = "Active";
                    $vendorImage->created_at = now();
                    $vendorImage->save();
                    $id = $vendorImage->id;
                }
            }
            
            if($uploadImage['status']){
                //image uploaded successfully 
                return response()->json([
                    'status' => true,
                    "message" => $uploadImage['message'],
                    'link' =>  $uploadImage['url'],
                    'id' => $id
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    "message" => $uploadImage['message'],
                    'link' =>  '',
                    'id' => $id
                ], 200);
            }
        }

        return response()->json([
            'status' => false,
            "message" => 'Upload Image Error',
            'link' => ''
        ], 200);
    }

    public function razorpayOrderCreation(Request $request){
        $validator = Validator::make($request->all(), [
            'plan_id' =>  'required', // 'users' is the table name, and 'email' is the column 
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }
        //$input = $request->all();

        $planDetails = Plan::find($request->input('plan_id'));
        if(!empty($planDetails)){
            $api = new Api(env('RAZOR_PAY_KEY'), env('RAZOR_PAY_SECRET_KEY'));
            $orderDetails = $api->order->create(array('amount' => $planDetails->amount*100, 'currency' => 'INR' ,'notes'=> array('plan_id'=> $request->input('plan_id'))));
            if(!isset($orderDetails['error'])){
                $RazorPayOrder = new RazorPayOrder();
                $RazorPayOrder->order_id = $orderDetails->id;
                $RazorPayOrder->user_id = auth('api')->user()->id;
                $RazorPayOrder->plan_id = $request->input('plan_id');
                $RazorPayOrder->save();
                $data = [
                    'order_id' => $orderDetails->id,
                    'amount' => $planDetails->amount,
                    'name' => $planDetails->name,
                    'user_name' => auth('api')->user()->name,
                    'razorpay_key' => env('RAZOR_PAY_KEY'),
                    'razorpay_secret_key' => env('RAZOR_PAY_SECRET_KEY')
                ];
                $response = ["status" =>true ,"message" => "Order Id created Successfully" , 'data' => $data];
                return response($response, 200);
            }else{
                //error fom Razorpay
                $response = ["status" =>false ,"message" => $orderDetails['error']['description'] ,'data' => []];
                return response($response, 200);
            }
        }else{
            $response = ["status" =>false ,"message" => "Plan id Does not exists" ,'data' => []];
            return response($response, 200);
        }
    }

    public function updateOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'order_id' =>  'required',
            'razorpay_payment_id' =>  'required',
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }

        $response = $this->checkPaymentAndUpdate(['order_id' => $request->input('order_id')?? null ,'razorpay_payment_id' => $request->input('razorpay_payment_id') , 'userId' => auth('api')->user()->id ,'from' => 'mobile']);

        if($response['status']){
            $response = ["status" =>true ,"message" => $response['success'] ,'data' => $response['data']];
            return response($response, 200);
        }else{
            $response = ["status" =>false ,"message" => $response['error'] ,'data' => []];
            return response($response, 200);
        }




    }

    public function updateUserServiceStatus(Request $request){
        $validator = Validator::make($request->all(), [
            'lead_id' =>  'required',
            'status' => 'required|in:Hired,Archived',
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }

        $userId = auth('api')->user()->id;

        $leadId = $request->input('lead_id');
        $status = $request->input('status');

        $lead = LeadUser::where(['lead_id'=>$leadId , 'user_id' => $userId])->first();
        if($lead === null){
            $response = ["status" =>false ,"message" => "Lead Not Tagged to this user" ,'data' => []];
            return response($response, 200);
        }else{
            LeadUser::where(['lead_id'=>$leadId , 'user_id' => $userId])->update(['response_status'=>$status]);
            $response = ["status" =>true ,"message" => "Status Updated Successfully" ,'data' => []];
            return response($response, 200);
        }

    }

    public function allLocations(){
        $userId = auth('api')->user()->id;
        $locations = Location::where(['user_id' => $userId])->get();

        //location Services
        foreach($locations as $l => $location){

            $locations[$l]['user_service'] =UserServiceLocation::with('service')->where(['user_id' => $userId , 'location_id' => $location->id ,'status' => 'Active'])->get();
        }
        $response = ["status" =>true ,"message" => "Locations" ,'data' => $locations];
        return response($response, 200);
    }

    public function addLocation(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:nationwide,distance',
            'distance_value' => 'required_if:type,distance',
            'latitude' => 'required_if:type,distance',
            'longitude' => 'required_if:type,distance',
            'address' => 'required_if:type,distance',
            'services' => 'required',
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }

        $userId = auth('api')->user()->id;

        $location = new Location();
        $location->type = $request->input('type');
        $location->user_id = $userId;
        if($request->input('type') == 'distance'){
            $location->latitude = $request->input('latitude');
            $location->longitude = $request->input('longitude');
            $location->pincode = '12345';
            $location->address = $request->input('address');
            $location->distance_value = $request->input('distance_value');
            
        }
   
        $location->save();

        $serviceIds = explode(',' , $request->input('services'));
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
        $locations = $this->allLocations();
        $response = ["status" =>true ,"message" => "Location Added Successfully" ,'data' => json_decode($locations->getContent(),true)['data']];
        return response($response, 200);
    }

    public function editLocation(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:nationwide,distance',
            'distance_value' => 'required_if:type,distance',
            'latitude' => 'required_if:type,distance',
            'longitude' => 'required_if:type,distance',
            'address' => 'required_if:type,distance',
            'services' => 'required',
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }
        $locationDetails = Location::find($request->input('id'));
        $userId = auth('api')->user()->id;
        if($locationDetails === null){
            $response = ["status" =>false ,"message" => "Location Not Found" ,'data' => []];
            return response($response, 200);
        }
        $locationDetails->type = $request->input('type');
        $locationDetails->user_id = $userId;
        if($request->input('type') == 'distance'){
            $locationDetails->latitude = $request->input('latitude');
            $locationDetails->longitude = $request->input('longitude');
            $locationDetails->pincode = '12345';
            $locationDetails->address = $request->input('address');
            $locationDetails->distance_value = $request->input('distance_value');
        }
        $locationDetails->save();
        $serviceIds = explode(',' , $request->input('services'));

        //deleting unwanted user Service Location 
        UserServiceLocation::where(['location_id' => $request->input('id')])->whereNotIn('service_id' , $serviceIds)->delete();

        //updating or adding new user Service Location
        foreach($serviceIds as $key => $value){
            $userServiceLocation = UserServiceLocation::where(['user_id' => $userId , 'service_id' => $value , 'status' => 'Active' ,'location_id' =>$request->input('id')])->first();

            if($userServiceLocation === null){

                //insert
                $serviceUser = ServiceUser::where(['user_id' => $userId , 'service_id' => $value , 'status' => 'Active'])->first();
                $userServiceLocation = new UserServiceLocation();
                $userServiceLocation->user_id = $userId;
                $userServiceLocation->service_id = $value;
                $userServiceLocation->location_id = $locationDetails->id;
                $userServiceLocation->service_user_id = $serviceUser->id;
                $userServiceLocation->status = 'Active';
                $userServiceLocation->save();

            }else{
                //update
                $userServiceLocation->status = 'Active';
                $userServiceLocation->save();
            }
        }
        $locations = $this->allLocations();
        $response = ["status" =>true ,"message" => "Location Updated Successfully" ,'data' => json_decode($locations->getContent(),true)['data']];
        return response($response, 200);

    }

    public function deleteLocation(Request $request){
        $validator = Validator::make($request->all(), [
            'location_id' => 'required',
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }
        $location = Location::find($request->input('location_id'));
        if($location === null){
            $response = ["status" =>false ,"message" => "Location Not Found" ,'data' => []];
            return response($response, 200);
        }
        $location->delete();
        UserServiceLocation::where('location_id' , $request->input('location_id'))->delete();
        $locations = $this->allLocations();
        $response = ["status" =>true ,"message" => "Location Deleted Successfully" ,'data' => json_decode($locations->getContent(),true)['data']];
        return response($response, 200);
    }


    public function requestReview(Request $request){
        $validator = Validator::make($request->all(), [
            'lead_id' => 'required',
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        } 

        $leadId = $request->input('lead_id');
        $requesteduserId = auth('api')->user()->id;
        $leadDeatils = Lead::find($leadId);
        $reviewLeadChecker = ReviewLeadChecker::where(['lead_id' => $leadId , 'email' => $leadDeatils->email])->get();
        if($reviewLeadChecker->count() > 0){
            $url = route('requestReview', ['token' => Crypt::encrypt($reviewLeadChecker[0]->id)]);
            $response = ["status" =>false ,"message" => "Request Already Sent" , 'link'=>$url];
            
            return response($response, 200);
        }else{
            $reviewLeadChecker = new ReviewLeadChecker();
            $reviewLeadChecker->lead_id = $leadId;
            $reviewLeadChecker->email = $leadDeatils->email;
            $reviewLeadChecker->requested_user_id= $requesteduserId;
            $reviewLeadChecker->save();
            $url = route('requestReview', ['token' => Crypt::encrypt($reviewLeadChecker->id)]);
            //sending email
        }
     
        $response = ["status" =>true ,"message" => "Request Sent Successfully",  'link'=>$url];
        return response($response, 200);
    }

    public function review(Request $request){

        $userId = auth('api')->user()->id;
        $review = Review::with('lead')->where(['user_id' => $userId])->get();
        $response = ["status" =>true ,"message" => "Vendor Reviews" ,'data' => $review];
        return response($response, 200);
    }

    

    public function deleteGalleryImage(Request $request){
        $validator = Validator::make($request->all(), [
            'image_id' => 'required',
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }

        $images = $request->input('image_id');
        $images =explode("," , $images);
        foreach($images as $image){
            $vendorImage = VendorImage::find($image);
            $originalPath = User::$imageCompanyUrl;
            if($vendorImage != null){
                deleteImage($originalPath, $vendorImage->image);
                $vendorImage->delete();
            }
        }

        $response = ["status" =>true ,"message" => "Image Deleted Successfully" ,'data' => []];
        return response($response, 200);


    }
}
