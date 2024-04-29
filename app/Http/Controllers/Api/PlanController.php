<?php

namespace App\Http\Controllers\Api;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function plan(){
        $plans = Plan::where(['status' => 'Active'])->get();
        foreach ($plans as $key => $value) {
            $plans[$key]['per_credit_cost'] = $plans[$key]['amount'] / $plans[$key]['no_of_credits'];
        }
        $response['data'] =  $plans;
        $response['message'] =  "Active plans";
        $response['status'] = true;
        return response($response, 200);
    }
}
