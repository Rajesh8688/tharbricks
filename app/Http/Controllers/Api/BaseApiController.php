<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Review;
use App\Models\ServiceUser;
use App\Models\VendorImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VendorDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    CONST API_PAGINATION = 10;
    CONST SUCCESS_MSG = "success";
    CONST FAILED_MSG = "failed";

 



    public function __construct()
    {

        /*if (\request()->get('lang')) {
            app()->setLocale(strtolower(request()->get('lang')));
        }
        $setting = \config('settings');
        view()->share(['_setting' => $setting]);*/

    }

    public function ApiImage($path,$dbfiels="image")
    {
        $ApiImageBasepath = env("APP_URL").$path;
        return $image = DB::raw("CONCAT('$ApiImageBasepath',$dbfiels) AS $dbfiels");
    }

    public function sendResponse($status, $keyVal)
    {
        $arrayResponse = [];
        $arrayResponse['status'] = $status;
        foreach ($keyVal as $key => $value) {
            // print_r($value) ;exit;
            $arrayResponse[$key] = $this->nonul($value);
        }
        return response()->json($arrayResponse);
    }

    public function nonul($value)
    {
        if ($value == NULL || $value == '' || empty($value)) {
            $value = array();
        }
        return $value;
    }

    public function emptyObject()
    {
        return $emptyObj = (object)NULL;
    }


    // public function sendFcmNotification($titleAr, $titleEn, $contentAr, $contentEn, $token, $userId = null)
    // {

    //     if ($userId != null) {
    //         if (is_array($userId)) {
    //             foreach ($userId as $item) {
    //                 DB::table('notifications')->insert(['user_id' => $item, 'titleEn' => $titleEn, 'contentEn' => $contentEn, 'titleAr' => $titleAr, 'contentAr' => $contentAr]);
    //             }
    //         } else {
    //             \DB::table('notifications')->insert(['user_id' => $userId, 'titleEn' => $titleEn, 'contentEn' => $contentEn, 'titleAr' => $titleAr, 'contentAr' => $contentAr]);
    //         }
    //     }

    //     $url = "https://fcm.googleapis.com/fcm/send";
    //     $serverKey = env('SERVER_KEY');
    //     $notification = array('title' => $titleEn, 'text' => $contentEn, 'sound' => 'default', 'badge' => '1');
    //     $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority' => 'high');
    //     $json = json_encode($arrayToSend);
    //     $headers = array();
    //     $headers[] = 'Content-Type: application/json';
    //     $headers[] = 'Authorization: key=' . $serverKey;
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     //Send the request
    //     $response = curl_exec($ch);
    //     //Close request
    //     if ($response === FALSE) {
    //         curl_close($ch);
    //         return false;
    //         //die('FCM Send Error: ' . curl_error($ch));
    //     }
    //     curl_close($ch);
    //     return true;


    // }

    function generateAPIToken()
    {
        return $token = hash('sha256', Str::random(60));
    }



    public function amenitesmakeArr($ameneties)
    {
        if (count($ameneties) > 0) {
            foreach ($ameneties as $amenety) {
                $out[$amenety] = $amenety;
            }
        } else {
            $out = array();
        }

        return $out;
    }

    public function profileInfo($userId){
        $user = User::find($userId);
        if (!$user) {
            return ['status' => false , 'data' => [] ,'message' => 'user not found'] ;
        }
        if(!empty($user->profile_pic)){
            $user->profile_pic = env("APP_URL")."/uploads/users/".$user->profile_pic;
        }
        //getting all the vendor info from vendor table
        $vendorInfo =  VendorDetails::where("user_id" , $user->id)->first();
        unset($vendorInfo->id);
        if(!empty($vendorInfo->company_logo)){
            $vendorInfo->company_logo = env("APP_URL")."/uploads/company/".$vendorInfo->company_logo;
        }

        //getting all the review from review table
        $reviewDetails = (int) Review::where('status' , 'Active')->where('user_id' , $user->id)->avg('rating');

        $userData = array_merge($user->toArray() ,$vendorInfo->toArray(),['review' => $reviewDetails]);
        $vendorImages = VendorImage::select('id',$this->ApiImage("/uploads/company/","image" ))->where(['user_id' => $user->id,'status' => 'Active'])->get();
        $userData['vendor_image'] = $vendorImages->toArray();

        //user Services

        //$userData['services'] = DB::select('SELECT s.*,su.id as service_user_id FROM service_users su left join services s on s.id = su.service_id  WHERE  su.status = ? and su.user_id = ?', ['Active',$userId]);
        //$userData['services'] = ServiceUser::select('service.*')->with('service')->where('user_id' , $user->id)->get();
        

        return ['status' => true , 'data' => $userData ,'message' => 'User Information'] ;
    }


}
