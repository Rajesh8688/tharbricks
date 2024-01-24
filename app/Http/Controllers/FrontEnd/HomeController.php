<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Plan;
use App\Models\Service;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $titles = [
            'title' => "Home",
        ];
        $Services = Service::where("status" , "Active")->get();
        $Plans = Plan::with('Details')->OrderBy('order' ,'asc')->get();
        return view('front_end.index',compact('titles','Services','Plans'));
    }

    public function contactUs(){
        $titles = ['title' => "Contact Us"];
        return view('front_end.contact_us',compact('titles'));
    }

    public function submitContactUs(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $userRequest = new UserRequest ;

        $userRequest->name = $request->input('name');
        $userRequest->email = $request->input('email');
        $userRequest->phone = $request->input('phone');
        $userRequest->subject = $request->input('subject');
        $userRequest->message = $request->input('message');

        if($userRequest->save()){

            //mail function need to implement

            return redirect()->route('contactUs')->with('success','Submited successfully.');
        }else{
            return redirect()->route('contactUs')->with('error','something went wrong');
        }
    }

    public function Signup(Request $request)
    {
        if(Auth::guard('web')->check()){
            return redirect()->route('vendor-dashboard');
        }
        $titles = [
            'title' => "SignUp",
        ];
        $services = Service::where('status' ,'Active')->get();
        return view('front_end.auth.signup',compact('titles' , 'services'));
    }
}
