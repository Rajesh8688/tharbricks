<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\ServiceUser;
use App\Models\VendorImage;
use Illuminate\Http\Request;
use App\Models\VendorDetails;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CreditTransactionLog;
use Illuminate\Support\Facades\Hash;
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
        $user = User::find(auth('api')->user()->id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if(!empty($user['profile_pic'])){
            $user->profile_pic = env("APP_URL")."/uploads/users/".$user['profile_pic'];
        }
        //getting all the vendor info from vendor table
        $vendorInfo =  VendorDetails::where("user_id" , $user->id)->first();

        $userData = array_merge($user->toArray() ,$vendorInfo->toArray());
        $vendorImages = VendorImage::select('id',$this->ApiImage("/uploads/company/","image" ))->where(['user_id' => $user->id,'status' => 'Active'])->get();
        $userData['vendor_image'] = $vendorImages->toArray();
        return response()->json(['message' => 'User Information' ,'data'=> $userData, 'status' => true]);
    }


    public function UpdateProfile(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => ['email',Rule::unique('users', 'email')], // 'users' is the table name, and 'email' is the column name
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }

        $userTableUpdate = ['name' , 'first_name' , 'last_name' , 'mobile' , 'address', 'email' , 'description'];

        $vendorTableUpdate = ['company_name' , 'company_description' , 'company_size' ,'website' , 'facebook_url' , 'twitter_url' , 'youtube_url' , 'alter_mobile' , 'company_address' ,'years_in_business','linked_in_url','pinterest_url','instagram_url'];

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

        

        if(!empty($user['profile_pic'])){
            $user->profile_pic = env("APP_URL")."/uploads/users/".$user['profile_pic'];
        }

        $userData = array_merge($user->toArray() ,$vendorInfo->toArray());
        $vendorImages = VendorImage::select('id',$this->ApiImage("/uploads/company/","image" ))->where(['user_id' => $user->id,'status' => 'Active'])->get();
        $userData['vendor_image'] = $vendorImages->toArray();
        return response()->json(['message' => 'User Information updated successfully' ,'data'=> $userData, 'status' => true]);


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
}
