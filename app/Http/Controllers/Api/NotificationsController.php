<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    
    public function notifications(){
        $Notifications = Notification::where(['status' => 'Active' ])->where(function ($query) {
            $query->where('user_id', auth('api')->user()->id)
                  ->orWhere('to_all', 1);
        })->orderBy('id','desc')->get();
        
        $response['data'] =  $Notifications;
        $response['message'] =  __('lang.notifications_list');
        $response['status'] = true;
        return response($response, 200);
    }
}
