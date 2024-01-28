<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Lead;
use App\Models\User;
use App\Models\Service;
use App\Models\LeadUser;
use App\Models\LeadAnswer;
use App\Models\ServiceUser;
use Illuminate\Http\Request;
use App\Models\VendorDetails;
use App\Models\VendorService;
use Illuminate\Validation\Rule;
use App\Models\NotInterestedLead;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CreditTransactionLog;
use App\Models\ResponseActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class VendorController extends Controller
{
    public function create(Request $request){
        if(Auth::guard('web')->check()){
            return redirect()->route('vendor-dashboard');
        }
        $this->validate($request, [
            'serviceId' => 'required'
        ]);

        $titles = [
            'title' => "SignUp",
        ];

        $serviceSlugs = $request->input('serviceId');
        $servicesSlug = implode("," , $serviceSlugs);

        return view('front_end.auth.create_vendor',compact( 'servicesSlug' , 'titles'));
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
            'servicesSlug' => 'required',
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
            //adding credits to vendor
            $vendorDetails->credits = 10000;
            $creditLogs = new CreditTransactionLog();

            $creditLogs->user_id = $user_id;
            $creditLogs->credits = 10000;
            $creditLogs->remaining_credits = 10000;
            $creditLogs->action = "added";
            $creditLogs->credits_desctiption = "10000 Join Bonus credits";
            $creditLogs->date_of_transaction = now();
            $creditLogs->save();
            $creditLogs->unique_id = 'CT'.str_pad($creditLogs->id, 8, '0', STR_PAD_LEFT);
            $creditLogs->save();


            if($request->input('see_leads_from') == 'custom' ){
                $vendorDetails->serve_customer_with_in = $request->input('serve_customer_with_in');
                $vendorDetails->pin_code = $request->input('pin_code');
            }

            $vendorDetails->save();

            $serviceSlugs = explode("," , $request->input('servicesSlug'));
            foreach ($serviceSlugs as $serviceSlug) {
               $serviceDetails = Service::where('slug' , $serviceSlug)->first();
               if($serviceDetails){
                    $ServiceUser = new ServiceUser();
                    $ServiceUser->user_id = $user_id;
                    $ServiceUser->service_id =  $serviceDetails->id;
                    $ServiceUser->status =  "Active";
                    $ServiceUser->save();
               }
            }

            Auth::guard('web')->loginUsingId($user_id);

            return redirect()->route('vendor-dashboard')->with('success', 'Vendor Created successfully');

        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['error' => 'The Message']);
            //return redirect()-back()->with('error','something went wrong');
        }
    }


    public function dashboard(){
        $titles = [
            'title' => "Vendor Dashboard",
        ];
        $unInterestedLeads = NotInterestedLead::select('lead_id')->where(['user_id' => auth('web')->user()->id ,"status" => 'Active'])->get();
        $userServices = ServiceUser::select('service_id')->where(['user_id' => auth('web')->user()->id , "status" => 'Active'])->get();
        $leads = Lead::with('service')->where("status" , "Active")->whereIn('service_id' ,$userServices);
        if(!empty($unInterestedLeads)){
            $leads = $leads->whereNotIn('id',$unInterestedLeads);
        }
        $data['totalLeads'] = count($leads->get());

        $data['totalResponses'] = count(LeadUser::where("status" , 'Active')->get());

        $vendorDetails = VendorDetails::where("user_id" , auth('web')->user()->id)->first();
        return view('front_end.vendor.dashboard',compact('titles','vendorDetails','data'));
    }


  
}
