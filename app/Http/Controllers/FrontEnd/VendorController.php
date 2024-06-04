<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Lead;
use App\Models\Plan;
use App\Models\User;
use Razorpay\Api\Api;
use App\Models\Service;
use App\Models\Setting;
use App\Models\LeadUser;
use App\Models\LeadAnswer;
use App\Models\ServiceUser;
use App\Models\VendorImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RazorPayOrder;
use App\Models\VendorDetails;
use App\Models\VendorService;
use Illuminate\Validation\Rule;
use App\Models\ResponseActivity;
use App\Models\NotInterestedLead;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CreditTransactionLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
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
            $creditLogs->credits_description = "10000 Join Bonus credits";
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

        //titles
        $titles = [
            'title' => "Vendor Dashboard",
        ];

        //Leads
        $unInterestedLeads = NotInterestedLead::select('lead_id')->where(['user_id' => auth('web')->user()->id ,"status" => 'Active'])->get();
        $InterestedLeads = LeadUser::select('lead_id')->where(['user_id' => auth('web')->user()->id ,"status" => 'Active'])->get();
        $userServices = ServiceUser::select('service_id')->where(['user_id' => auth('web')->user()->id , "status" => 'Active'])->get();
        $leads = Lead::with('service')->where("status" , "Active")->whereIn('service_id' ,$userServices);
        if(!empty($unInterestedLeads)){
            $leads = $leads->whereNotIn('id',$unInterestedLeads);
        }
        if(!empty($InterestedLeads)){
            $leads = $leads->whereNotIn('id',$InterestedLeads);
        }
        $data['totalLeads'] = count($leads->get());

        //Responses
        $data['totalResponses'] = count(LeadUser::where(["status" => "Active" , "user_id" => auth()->user()->id])->get());

        //edits
        $vendorDetails = VendorDetails::where("user_id" , auth('web')->user()->id)->first();

        $totalUserfillablefields = ['first_name' , 'last_name' , 'name' ,'email' , 'mobile' ,'description' ,'profile_pic'  ];
        $totalCompanyfillablefields = ['company_name' , 'company_logo' , 'website' ,'alter_mobile' , 'comapny_size' ,'years_in_business' ,'company_description'];
        
        $totalFillableCount = count($totalUserfillablefields) + count($totalCompanyfillablefields);
        $totalFilledCount = 0;
        foreach($totalUserfillablefields as $item){
            if(!empty(auth()->user()->$item) || auth()->user()->$item != null){$totalFilledCount++; }
        }
        foreach($totalCompanyfillablefields as $item){
            if(!empty($vendorDetails->$item) || $vendorDetails->$item != null){$totalFilledCount++; }
        }

        $data['percentage'] = round(($totalFilledCount/$totalFillableCount)*100);

        $supportDetails = Setting::find(1);
        $data['email'] = $supportDetails->email;
        $data['phone_number'] = $supportDetails->phone_number;
        $data['address'] = $supportDetails->address;

        
        return view('front_end.vendor.dashboard',compact('titles','vendorDetails','data'));
    }

    //Vendor edit screen
    public function edit(){
        //we are taking by default login user id with out exposing user id
        $titles = [
            'title' => "Edit",
        ];
        $vendorDetails = VendorDetails::where('user_id' , auth()->user()->id)->first();

        $services = Service::where("status" , "Active")->get();
        $userServices = ServiceUser::select('service_id')->where(["user_id" => auth()->user()->id , 'status' => 'Active'] )->get();
        $userServicesIds = [];
        foreach($userServices as $item){
            $userServicesIds[] = $item->service_id;
        }
        $existingImages = [];
        $vendorImages = VendorImage::where(['user_id' => auth()->user()->id , 'status' => 'Active'])->get();
        foreach ( $vendorImages as $file ) {
            $obj['name'] = $file->image;
            $file_path = public_path('/uploads/company/').$file->image;
            $obj['size'] = filesize($file_path);          
            $obj['path'] = asset('/uploads/company/'.$file->image);
            $existingImages[] = $obj;
        }
        return view('front_end.vendor.edit',compact( 'titles','vendorDetails','services','userServicesIds','existingImages'));
    }

    //Update user details 
    public function updateUserDetails(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' =>  'required|email|unique:users,email,'.auth()->user()->id
        ]);
        $profilePic = $request->file('profile_pic');
        $companyLogo = $request->file('company_logo');
        $userDetails = User::find(auth()->user()->id);
        if ($profilePic != NULL) {
            if(!empty(auth()->user()->profile_pic)){
                // Delete the previous image
                deleteImage(User::$imagePath, auth()->user()->profile_pic);
            }
     
            $newFileName = time() . $profilePic->getClientOriginalName();
            $originalPath = User::$imagePath;

            // Image Upload Process
            $thumbnailImage = Image::make($profilePic);
            $thumbnailImage->save($originalPath . $newFileName);
            //$thumbnailImage->resize(601,511)->save($originalPath . $newFileName);
            $userDetails->profile_pic = $newFileName;
        }

        
        if ($companyLogo != NULL) {
            $vendorDetails =  VendorDetails::where("user_id" , auth()->user()->id)->first();
            $newFileName = time() . $companyLogo->getClientOriginalName();
            $originalPath = User::$imageCompanyUrl;
            if(!empty($vendorDetails->company_logo))
            {
                // Delete the previous image
                deleteImage(User::$imageCompanyUrl, $vendorDetails->company_logo);
            }
       

            // Image Upload Process
            $thumbnailImage = Image::make($companyLogo);
            $thumbnailImage->save($originalPath . $newFileName);
            //$thumbnailImage->resize(44,44)->save($originalPath . $newFileName);
            $vendorDetails->company_logo = $newFileName;
            $vendorDetails->save();
        }

        $userDetails->first_name = $request->first_name;
        $userDetails->last_name = $request->last_name;
        $userDetails->name = $request->name;
        $userDetails->email = $request->email;
        $userDetails->description = $request->description;
        if($userDetails->save()){
            return Redirect::back()->with(['success-info' => 'User Information Upadted Successfully']);
        }else{
            return Redirect::back()->withErrors(['error-info' => 'something went wrong']);
        }
    }

    //update company details

    public function updateCompanyDetails(Request $request){
   
        $this->validate($request, [
            'mobile' => 'nullable|regex:/^[0-9]{10}$/',
            'alter_mobile' => 'nullable|regex:/^[0-9]{10}$/',
            'website' => 'nullable|url'
        ]);
        $vendorDetails =  VendorDetails::where("user_id" , auth()->user()->id)->first();
        $vendorDetails->company_name = $request->company_name;
        $vendorDetails->website = $request->website;
        $vendorDetails->alter_mobile = $request->alter_mobile;
        $vendorDetails->company_size = $request->company_size;
        $vendorDetails->years_in_business = $request->years_in_business;
        $vendorDetails->company_description = $request->company_description;
        $userDeatils = User::find(auth()->user()->id);
        if(!empty($request->mobile)){
            $userDeatils->mobile = $request->mobile;
            $userDeatils->save();
        }
        if($vendorDetails->save()){
            return Redirect::back()->with(['success-info' => 'Comapny details Updated successfully']);
        }else{
            return redirect()->back()->with(['error-info' => 'Something went wrong']);;
        }

    }

    //update social media details

    public function updateSocialMediaDetails(Request $request){
        $this->validate($request, [
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linked_in_url' => 'nullable|url',
            'pinterest_url' => 'nullable|url',
            'instagram_url' => 'nullable|url'
        ]);
        $vendorDetails =  VendorDetails::where("user_id" , auth()->user()->id)->first();
        $vendorDetails->facebook_url = $request->facebook_url;
        $vendorDetails->twitter_url = $request->twitter_url;
        $vendorDetails->linked_in_url = $request->linked_in_url;
        $vendorDetails->pinterest_url = $request->pinterest_url;
        $vendorDetails->instagram_url = $request->instagram_url;

        if($vendorDetails->save()){
            return Redirect::back()->with(['success-info' => 'Social Media Details Updated successfully']);
        }else{
            return redirect()->back()->with(['error-info' => 'Something went wrong']);
        }
    }

    public function updateQuestions(Request $request){
        $vendorDetails =  VendorDetails::where("user_id" , auth()->user()->id)->first();
        $vendorDetails->what_do_you_love_most_about_your_job = $request->what_do_you_love_most_about_your_job;
        $vendorDetails->what_inspired_you_to_start_your_own_business = $request->what_inspired_you_to_start_your_own_business;
        $vendorDetails->why_should_our_clients_choose_you = $request->why_should_our_clients_choose_you;
        $vendorDetails->can_you_provide_your_service_online_or_remotely = $request->can_you_provide_your_service_online_or_remotely;
        $vendorDetails->what_changes_have_made_to_keep_customers_safe_from_covid19 = $request->what_changes_have_made_to_keep_customers_safe_from_covid19;
        $vendorDetails->how_long_have_you_been_in_business = $request->how_long_have_you_been_in_business;
        $vendorDetails->what_guarantee_does_your_work_comes_with = $request->what_guarantee_does_your_work_comes_with;

        if($vendorDetails->save()){
            return Redirect::back()->with(['success-info' => 'Question Answers Details Updated successfully']);
        }else{
            return redirect()->back()->with(['error-info' => 'Something went wrong']);
        }

    }

    //update Service Details

    public function updateServices(Request $request){
        $this->validate($request, [
            'serviceId' => 'required'
        ]);

        $services = $request->input('serviceId');

        // ServiceUser::Where('user_id', auth()->user()->id)->update((['status'=>'InActive']));
        //DB::table('service_users')->where('user_id', auth()->user()->id)->update(['status' => 'InActive']);
        ServiceUser::where('user_id', auth()->user()->id)->update(['status' => 'InActive']);

        foreach($services as $service){
            $serviceUser = ServiceUser::where(["user_id" => auth()->user()->id , "service_id" =>$service])->first();
            if(!empty($serviceUser)){
                //Activating service
                $serviceUser->status = "Active";
                $serviceUser->save();
            }else{
                $serviceUser = new ServiceUser();
                $serviceUser->user_id =  auth()->user()->id;
                $serviceUser->service_id =  $service;
                $serviceUser->status = "Active";
                $serviceUser->save();
            }
        }
        return Redirect::back()->with(['success-info' => 'Service Details Updated successfully']);
    }


    //Company image Upload
    public function uploadCompanyImage(Request $request){

        $this->validate($request, [
            'file' => 'required|max:10000|mimes:jpeg,jpg,png,gif' //a required
        ]);


       
        $image = $request->file('file');
        if ($image != NULL) {
            $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);

            $newFileName = imagenameMaker($filename , $extension);
            // $newFileName = time() . basename(Str::slug($image->getClientOriginalName()), '.'.$image->getClientOriginalExtension());
            $originalPath = User::$imageCompanyUrl;

            // Image Upload Process
            $thumbnailImage = Image::make($image);
            $thumbnailImage->save($originalPath . $newFileName);

            $vendorImage = new VendorImage();
            $vendorImage->user_id = auth()->user()->id;
            $vendorImage->image = $newFileName;
            $vendorImage->status = "Active";
            $vendorImage->created_at = now();
            $vendorImage->save();
            return response()->json(['success'=>$newFileName]);

        }
    }

    //company image removeal
    public function deleteCompanyImage(Request $request){
        if(!empty($request->get('filename')))
        {
            $filename =  $request->get('filename');
            $rsp = VendorImage::where(['image'=>$filename ,'user_id' => auth()->user()->id])->delete();
            $path=public_path().'/company/'.$filename;
            if (file_exists($path)) {
                unlink($path);
            }
            return $filename;  
        }
        return false;
       

    }

    //My Credits

    public function myCredits(){

        $titles = [
            'title' => "My-Credits",
        ];

        $plans = Plan::where(['status' => 'Active'])->get();

        $creditLogs = CreditTransactionLog::where(['user_id' => auth()->user()->id , 'status' => 'Active'])->orderBy('created_at', 'desc')->get();
        //dd($creditLogs);

        return view('front_end.vendor.credits',compact( 'titles' ,'creditLogs','plans'));

    }


    public function ChangePassword()
    {
        $titles = [
            'title' => "Change Password",
        ];
        
        return view('front_end.auth.change_password',compact('titles'));

    }

    public function UpdatePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where("id",Auth::user()->id)->update(['password' =>  Hash::make($request->input('new-password'))]);

        return redirect()->route('vendor-dashboard')->with('success','Password successfully changed!');
      
    }

    public function storePayment(Request $request){

        $input = $request->all(); 

        $razorPayPaymentId = $request->input('razorpay_payment_id');
        // $api = new Api(env('RAZOR_PAY_KEY'), env('RAZOR_PAY_SECRET_KEY'));
        // $payment = $api->payment->fetch($razorPayPaymentId); 
        //dd($payment);
        // if(!empty($payment)){
        //     $RazorPayOrder = new RazorPayOrder();
        //     $RazorPayOrder->order_id = $payment['order_id'];
        //     $RazorPayOrder->user_id = auth('web')->user()->id;
        //     $RazorPayOrder->plan_id = $payment['description'];
        //     $RazorPayOrder->save();
        // }
        $response = $this->checkPaymentAndUpdate(['order_id' =>  null ,'razorpay_payment_id' =>$razorPayPaymentId , 'userId' => auth('web')->user()->id]);
        //dd($response);

        if($response['status']){
            return redirect()->route('my-credits')->with('success', $response['success']);
        }else{
            return redirect()->route('my-credits')->with('error' , $response['error']);
        }


    }


  
}
