<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserRequest;

class HomeController extends Controller
{
    public function index(){
        $titles = [
            'title' => "Home",
        ];
        $Categories = Category::where("status" , "Active")->get();
        //return view('front_end.test');
        return view('front_end.index',compact('titles','Categories'));
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
}
