<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    public function appVersion()
    {
        $appversion = Setting::find(1);

        $response = ["status" =>true ,"message" => "App Versions" , 'data' => array( 'ios_vesions' => $appversion->app_ios_version , 'android_vesions' => $appversion->app_android_version) ];

        return response($response, 200);
    }
}
