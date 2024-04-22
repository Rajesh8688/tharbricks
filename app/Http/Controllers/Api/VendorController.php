<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\VendorImage;
use Illuminate\Http\Request;
use App\Models\VendorDetails;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CreditTransactionLog;
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

        return response()->json(['message' => 'User Information updated successfully' ,'data'=> [], 'status' => true]);


    }

    public function transactionLogs(Request $request){
        //function for getting transation logs
        $user = User::find(auth('api')->user()->id);
        $transactionLogs = CreditTransactionLog::where("user_id" , $user->id)->get();
        $response = ['data' => $transactionLogs,"status"=>true ,"message" => "user Transation Logs"];
        return response($response, 200);
    }
}
