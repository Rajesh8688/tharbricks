<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;

class BlogController extends Controller
{
    public function index(Request $request){
        $titles = [
            'title' => "Blogs",
        ];
        $serviceId = null;
        if($request->has('serviceId'))
        {
            $serviceId = $request->input('serviceId');
        }
        $blogs = Blog::where('status' , 'Active')->orderBy("id","DESC");
        if(!empty($serviceId))
        {
            $blogs = $blogs->where('service_id' , $serviceId);
        }
        $blogs = $blogs->paginate(4);
        $Recentblogs = Blog::where('status' , 'Active')->limit(4)->orderBy("id","DESC")->get();
       
        $services = Service::where('status' , 'Active')->get();
        foreach($services as $s=>$item){
            $services[$s]['blogCount'] = count(Blog::where('status' , 'Active')->where('service_id' , $item->id)->get());
        }
        return view('front_end.blogs.list',compact('titles','blogs','Recentblogs','services'));
    }

    public function blogDetails($slug){
        $blog = Blog::where('slug',$slug)->first();
        $Recentblogs = Blog::where('status' , 'Active')->where('slug','!=',$slug)->limit(4)->orderBy("id","DESC")->get();
        $services = Service::where('status' , 'Active')->get();
        foreach($services as $s=>$item){
            $services[$s]['blogCount'] = count(Blog::where('status' , 'Active')->where('service_id' , $item->id)->get());
        }
        if(empty($blog) || $blog == null)
        {
            $titles = [
                'title' => "Something went wrong",
            ];
            return view('front_end.error',compact('titles','Recentblogs','services'));
        }
        $titles = [
            'title' => "blogs",
        ];
        
        return view('front_end.blogs.details',compact('titles','blog','Recentblogs','services'));
    }
}
