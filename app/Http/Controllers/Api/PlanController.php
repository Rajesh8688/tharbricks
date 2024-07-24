<?php

namespace App\Http\Controllers\Api;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VendorDetails;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function plan(){
        $plans = Plan::where(['status' => 'Active'])->get();
        $available_credit = 0;
        if (Auth::guard('api')->check())
        {
            $vendorDetails = VendorDetails::where('user_id' , auth('api')->user()->id)->first();
            $available_credit = $vendorDetails->credits;
        }
     
        foreach ($plans as $key => $value) {
            $plans[$key]['per_credit_cost'] = $plans[$key]['amount'] / $plans[$key]['no_of_credits'];
        }
        $response['data']['plans'] =  $plans;
        $response['data']['available_credit'] =  $available_credit;
        $response['message'] =  __('lang.active_plans');
        $response['status'] = true;
        return response($response, 200);
    }
}
