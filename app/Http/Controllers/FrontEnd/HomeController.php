<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $titles = [
            'title' => "Home",
        ];
        $Categories = Category::where("status" , "Active")->get();
        return view('front_end.index',compact('titles','Categories'));
    }

    public function contactUs(){
        $titles = ['title' => "Contact Us"];
        return view('front_end.contact_us',compact('titles'));
    }
}
