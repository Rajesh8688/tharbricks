<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index(){
        $titles = [
            'title' => "Services",
        ];

        $services = Service::where('status' , 'Active')->paginate(10);
        $serviceCount = Service::where('status' , 'Active')->count();
       
        return view('front_end.service.list',compact('titles','services','serviceCount'));

    }

    public function serviceDetails($slug){
        $service = Service::where('slug',$slug)->first();
        $services = Service::where('slug','!=',$slug)->orderBy('created_at',"DESC")->get();
        if(empty($service) || $service == null)
        {
            $titles = [
                'title' => "Something went wrong",
            ];
            return view('front_end.error',compact('titles'));
        }
        $titles = [
            'title' => "services",
        ];
        return view('front_end.service.details',compact('titles','service','services'));

    }

    
}
