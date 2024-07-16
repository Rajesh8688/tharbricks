<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Blog;
use App\Models\Plan;
use App\Models\User;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use App\Models\ReviewLeadChecker;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    public function index(){
        $titles = [
            'title' => "Home",
        ];
        $Services = Service::where("status" , "Active")->get();
        $Testimonials = Testimonial::with('service')->where("status" , "Active")->get();
        $Vendors = User::with('vendorDetails')->where("is_vendor" , '1')->where("status" , "Active")->get();
        $Blogs = Blog::with('service')->where("status" , "Active")->orderBy('id' ,'DESC')->get();
        $noImage = asset(Config::get('constants.NO_IMG_ADMIN'));
        //dd($Vendors);
        // $Plans = Plan::with('Details')->OrderBy('order' ,'asc')->get();
        return view('front_end.index',compact('titles','Services','Testimonials','Vendors','noImage','Blogs'));
    }

    public function contactUs(){
        $titles = ['title' => "Contact Us"];
        $supportDetails = Setting::find(1);
        $data['email'] = $supportDetails->email;
        $data['phone_number'] = $supportDetails->phone_number;
        $data['address'] = $supportDetails->address;
        return view('front_end.contact_us',compact('titles','data'));
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

    public function review($token){
        $reviewLeadCheckerId = Crypt::decrypt($token);
        $reviewLeadChecker = ReviewLeadChecker::find($reviewLeadCheckerId);

        if($reviewLeadChecker->count() == 0){
            //no review found
            $message = 'Something went wrong';
            return view('front_end.review.error' , compact('message'));
        }    
        else{
            if($reviewLeadChecker->status != "Answered"){
                //show review form
                $reviewLeadChecker->status = "opened";
                $reviewLeadChecker->save();
                return view('front_end.review.form',compact('reviewLeadCheckerId'));
            }elseif($reviewLeadChecker->status == "Answered"){
                //reviewed
                $message = 'Review Already Submitted';
                return view('front_end.review.error' , compact('message'));
            }
        }    
     
    }

    public function reviewSubmit(Request $request){
        $this->validate($request, [
            'rating' => 'required',
            'comment' => 'required',
            'reviewLeadCheckerId' => 'required'
        ]);
        $reviewLeadCheckerId = $request->input('reviewLeadCheckerId');

        $reviewLeadChecker =  ReviewLeadChecker::find($reviewLeadCheckerId);
        if($reviewLeadChecker->status != "Answered"){
            $reviewLeadChecker->status = "Answered";
            $reviewLeadChecker->save();
            $review = new Review();
            $review->rating = $request->input('rating');
            $review->comment = $request->input('comment');
            $review->email = $reviewLeadChecker->email;
            $review->lead_id = $reviewLeadChecker->lead_id;
            $review->user_id = $reviewLeadChecker->requested_user_id;
            $review->save();
            return view('front_end.review.success');
        }else{
            $message = 'Review Already Submitted';
            return view('front_end.review.error' , compact('message'));
        }
    }

    public function reviewSuccess(){
        return view('front_end.review.success');
    }
    public function reviewFailure(){
        $message = 'Something went wrong';
        return view('front_end.review.error' , compact('message'));
    }

    public function changeLang($lang)
    {
        session(['lang' => $lang]);
        return redirect()->back();
    }

    public function emailChecker(){
        return view('front_end.email_templates.estimation');
    }
}
