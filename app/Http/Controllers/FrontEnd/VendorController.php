<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Lead;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\VendorDetails;
use App\Models\VendorCategory;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\LeadAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class VendorController extends Controller
{
    public function create(Request $request){
        if(Auth::guard('web')->check()){
            return redirect()->route('vendor-dashboard');
        }
        $this->validate($request, [
            'categoryId' => 'required'
        ]);

        $titles = [
            'title' => "SignUp",
        ];

        $categorySlugs = $request->input('categoryId');
        $categorysSlug = implode("," , $categorySlugs);

        return view('front_end.auth.create_vendor',compact( 'categorysSlug' , 'titles'));
    }

    public function storeVendor(Request $request){
        if(Auth::guard('web')->check()){
            return redirect()->route('vendor-dashboard');
        }
        $this->validate($request, [
            'name' => 'required',
            'company_size' => 'required',
            'see_leads_from' => 'required',
            'serve_customer_with_in' => 'required_if:see_leads_from,custom',
            'pin_code' => 'required_if:see_leads_from,custom',
            'email' => ['required','email',Rule::unique('users', 'email')], // 'users' is the table name, and 'email' is the column name
            'mobile' => 'required',
            'categorysSlug' => 'required',
            'password' => [
                'confirmed',
                'required',
                'string',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ]);
        
        
        try {
            $user = new User();
            $user->first_name = null;
            $user->last_name = null;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->password = bcrypt($request->input('password'));
            $user->back_end_user = 0;
            $user->status = 'Active';
            $user->is_vendor = '1';
            $user->save();

            $user_id = $user->id;

            $vendorDetails = new VendorDetails();
            $vendorDetails->user_id = $user_id;
            $vendorDetails->company_name = $request->input('company_name');
            $vendorDetails->company_size = $request->input('company_size');
            $vendorDetails->website = $request->input('website');
            $vendorDetails->see_leads_from = $request->input('see_leads_from');

            if($request->input('see_leads_from') == 'custom' ){
                $vendorDetails->serve_customer_with_in = $request->input('serve_customer_with_in');
                $vendorDetails->pin_code = $request->input('pin_code');
            }

            $vendorDetails->save();

            $categorySlugs = explode("," , $request->input('categorysSlug'));

            foreach ($categorySlugs as $categorySlug) {
               $categoryDetails = Category::where('slug' , $categorySlug)->first();
               if($categoryDetails){
                    $vendorCategory = new VendorCategory();
                    $vendorCategory->user_id = $user_id;
                    $vendorCategory->category_id =  $categoryDetails->id;
                    $vendorCategory->status =  1;
               }
               $categoryDetails->save();
            }

            Auth::guard('web')->loginUsingId($user_id);

            return redirect()->route('vendor-dashboard')->with('success', 'Vendor Created successfully');

        } catch (\Throwable $th) {
            dd($th);
            return Redirect::back()->withErrors(['error' => 'The Message']);
            //return redirect()-back()->with('error','something went wrong');
        }
    }


    public function dashboard(){
        // dd(auth()->user());
        $titles = [
            'title' => "Vendor Dashboard",
        ];

        return view('front_end.vendor.dashboard',compact('titles'));

    }


    public function leads(){
        $titles = [
            'title' => "Vendor Leads",
        ];

        $leads = Lead::with('category')->where("status" , "Active")->get();
        $firstLead = null;
        $lead = null;

        foreach($leads as $k=>$lead){
            if($k == 0){
                $firstLead = $lead->id;
            }
            $leadAnswers = LeadAnswer::where("lead_id" , $lead->id)->get();
            $LeadAns = [];
            foreach($leadAnswers as $leadAnswer)
            {
                $LeadAns[] = ucfirst($leadAnswer->answer_text);
            }
            $lead->leadAnswers = implode("|",$LeadAns);
            $lead->leadAnswersShort = substr($lead->leadAnswers,0,60).((strlen($lead->leadAnswers) > 60) ? "...":"");
            $lead->lead_added_on = $lead->created_at->diffForHumans(null,null,true);
        }
        $lead = $firstLead;
        if($firstLead){
            $lead = Lead::with('category')->find($firstLead);
            $email = explode("@",$lead->email);
            $lead->encrypted_email = "**********@".$email[1];
            $lead->encrypted_phone = "*******".substr ($lead->phone, -3);
            $leadAnswers = LeadAnswer::with('question')->where("lead_id" , $lead->id)->where("status" , "Active")->get();
            $lead->leadAnswers = $leadAnswers;
        }
        return view('front_end.vendor.leads',compact('titles' ,'leads' ,'lead'));
    }

    public function leadDetails(Request $request){
        $leadId = null;

        $leadId = $request->has('lead_id') ? $request->input('lead_id') : null;

        if(empty($leadId)){
            return response()->json(['error' => 'Lead Id Required'], 500);
        }else{
            $lead = Lead::with('category')->find($leadId);
            if(empty($lead)){
                return response()->json(['error' => 'Lead does not exist'], 500);
            }
            $email = explode("@",$lead->email);
            $lead->encrypted_email = "**********@".$email[1];
            $lead->encrypted_phone = "*******".substr ($lead->phone, -3);
            $leadAnswers = LeadAnswer::with('question')->where("lead_id" , $lead->id)->where("status" , "Active")->get();
            $lead->leadAnswers = $leadAnswers;

            return response()->json([
                'leadDetails' => view('front_end.vendor.vendor_details_view',compact('lead'))->render()
            ]);

            //view('front_end.vendor.leads',compact('titles' ,'leads' ,'lead'));


        }


    }
}
