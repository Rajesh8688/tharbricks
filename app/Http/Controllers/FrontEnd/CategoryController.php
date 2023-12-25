<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $titles = [
            'title' => "Catgories",
        ];

        $categories = Category::where('status' , 'Active')->paginate(10);
        $categoryCount = Category::where('status' , 'Active')->count();
       
        return view('front_end.category.list',compact('titles','categories','categoryCount'));

    }

    public function categoryDetails($slug){
        $category = Category::where('slug',$slug)->first();
        $categories = Category::where('slug','!=',$slug)->orderBy('created_at',"DESC")->get();
        if(empty($category) || $category == null)
        {
            $titles = [
                'title' => "Something went wrong",
            ];
            return view('front_end.error',compact('titles'));
        }
        $titles = [
            'title' => "categories",
        ];
        return view('front_end.category.details',compact('titles','category','categories'));

    }
}
