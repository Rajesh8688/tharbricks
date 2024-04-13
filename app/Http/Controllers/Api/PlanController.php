<?php

namespace App\Http\Controllers\Api;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function plan(){
        $plans = Plan::where(['status' => 'Active'])->get();
        $response['data'] =  $plans;
        $response['message'] =  "Active plans";
        $response['status'] = true;
        return response($response, 200);
    }
}
