<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends BaseApiController
{
    public function services(){
        $services = Service::where('status' ,'Active')->get();
        return response()->json([
            'status' => false,
            'message' => self::SUCCESS_MSG,
            "data" => $services
        ], 200);
    }
}
