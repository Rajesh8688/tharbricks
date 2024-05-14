<?php

namespace App\Http\Controllers\Api;

use App\Models\Plan;
use App\Models\User;
use Razorpay\Api\Api;
use App\Models\Service;
use App\Models\ServiceUser;
use App\Models\VendorImage;
use Illuminate\Http\Request;
use App\Models\RazorPayOrder;
use App\Models\VendorDetails;
use App\Models\RazorPayOrders;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CreditTransactionLog;
use Illuminate\Support\Facades\Hash;
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

        $vendorTableUpdate = ['company_name' , 'company_description' , 'company_size' ,'website' , 'facebook_url' , 'twitter_url' , 'youtube_url' , 'alter_mobile' , 'company_address' ,'years_in_business','linked_in_url','pinterest_url','instagram_url' ,'is_new_reviews_on_profile_push_notifications','is_new_leads_i_receive_push_notifications','is_customers_sending_me_a_message_push_notifications','is_new_lead_i_receive_email_notifications','is_customers_closing_leads_ive_responded_email_notifications','is_customers_dismissing_my_response_email_notifications','is_customers_hiring_me_email_notifications','is_customers_reading_a_message_i_sent_email_notifications','is_customers_requesting_a_call_form_me_email_notifications','is_customers_requesting_me_to_contact_them_email_notifications','is_customers_viewing_my_profile_email_notifications','is_customers_viewing_my_website_email_notifications','is_a_summary_of_leads_im_matched_to_each_day_email_notifications','is_customers_sending_me_a_message_email_notifications','is_new_reviews_on_my_profile_email_notifications','is_new_reviews_from_other_sources_email_notifications','company_email' ,'company_phone'];

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

    public function myServices(){
        //function for getting My Services
        $user = User::find(auth('api')->user()->id);

        $userServices = ServiceUser::with('user','service')->where('user_id' , $user->id)->get();

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

        if ($userId) {
                $extension = getBase64ImageExtension($image);
                //$imageInfo = getimagesizefromstring(base64_decode($image));

                // $mime = $imageInfo['mime'];
                // $extension = explode('/', $mime)[1];
                 $newFileName = sha1(date('YmdHis') . rand(10, 90)) . "." . $extension;
                $imageInfo = base64_decode($image);
                //$imageInfo = imagecreatefromwebp($imageInfo);
                //$extension = getBase64ImageExtension($decodedImage);
                //dd($extension);

                if($request->type == 'profile_image'){
                    if(!empty(auth('api')->user()->profile_pic)){
                        // Delete the previous image
                        deleteImage(User::$imagePath, auth('api')->user()->profile_pic);
                    }
                    $originalPath = User::$imagePath;
                    // Image Upload Process
                    $thumbnailImage = Image::make($imageInfo);
                    $thumbnailImage->save($originalPath . $newFileName);
                    $userDetails = User::find($userId);
                    $userDetails->profile_pic = $newFileName;
                    $userDetails->save();
                    
                }elseif($request->type == 'company_logo'){
                    $vendorDetails =  VendorDetails::where("user_id" , auth()->user()->id)->first();
                    if(!empty($vendorDetails->company_logo))
                    {
                        // Delete the previous image
                        deleteImage(User::$imageCompanyUrl, $vendorDetails->company_logo);
                    }
                    $originalPath = User::$imageCompanyUrl;
                    // Image Upload Process
                    $thumbnailImage = Image::make($imageInfo);
                    $thumbnailImage->save($originalPath . $newFileName);
                    $vendorDetails->company_logo = $newFileName;
                    $vendorDetails->save();
                }elseif($request->type == 'company_gallery'){
                    //gallery
                    $originalPath = User::$imageCompanyUrl;

                    $thumbnailImage = Image::make($imageInfo);
                    $thumbnailImage->save($originalPath . $newFileName);
        
                    $vendorImage = new VendorImage();
                    $vendorImage->user_id = $userId;
                    $vendorImage->image = $newFileName;
                    $vendorImage->status = "Active";
                    $vendorImage->created_at = now();
                    $vendorImage->save();
                }
                return response()->json([
                    'status' => true,
                    "message" => 'image Uploaded successfully',
                    'link' =>  asset($originalPath . $newFileName)
                ], 200);
            
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

        $response = $this->checkPaymentAndUpdate(['order_id' => $request->input('order_id')?? null ,'razorpay_payment_id' => $request->input('razorpay_payment_id') , 'userId' => auth('api')->user()->id]);

        if($response['status']){
            $response = ["status" =>true ,"message" => $response['success'] ,'data' => $response['data']];
            return response($response, 200);
        }else{
            $response = ["status" =>false ,"message" => $response['error'] ,'data' => []];
            return response($response, 200);
        }




    }

    public function addService(Request $request){
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
        if ($serviceUser === null) {
            $service = Service::where(['id'=>$serviceId , 'status' => 'Active'])->first();
            if($service === null){
                $response = ["status" =>false ,"message" => "Service does not exists" ,'data' => []];
                return response($response, 200);
            }
            $userservice = new ServiceUser();
            $userservice->user_id =  $userId ;
            $userservice->service_id = $serviceId;
            $userservice->save();
            $response = ["status" =>true ,"message" => "Service added successfully" ,'data' => []];
            return response($response, 200);
        }else{
            if($serviceUser->status == 'InActive'){
                $serviceUser->status = "Active";
                $serviceUser->save();
                $response = ["status" =>true ,"message" => "Service activated successfully" ,'data' => []];
                return response($response, 200);
            }else{
                $response = ["status" =>false ,"message" => "Service Already added" ,'data' => []];
                return response($response, 200);
            }
        }
   




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
            $response = ["status" =>true ,"message" => "Service Removed Successfully" ,'data' => []];
            return response($response, 200);
        }




    }
}
