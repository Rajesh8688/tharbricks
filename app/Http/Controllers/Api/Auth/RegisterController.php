<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Models\Service;
use App\Models\ServiceUser;
use Illuminate\Http\Request;
use App\Models\VendorDetails;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\CreditTransactionLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class RegisterController extends BaseApiController
{
    public function signup(Request $request){
        $validator = Validator::make($request->all(), [
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
            ]
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }

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


            if ($user) {
                $user = User::select('id','email','mobile','name',$this->ApiImage("/uploads/users/","profile_pic" ))->find($user->id);
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $info = $this->profileInfo($user->id);
                $response = ['user' => $info['data'],'token' => $token,"status"=>true ,"message" => "success"];
                $user->fcm_token = $request->input('fcm_token') ?? null;
                $user->save();
                return response($response, 200);
            }

        } catch (\Throwable $th) {
            return response(["status"=>false,'message'=>'something went wrong' , 'token' => "",'user'=> []], 200);
            //return redirect()-back()->with('error','something went wrong');
        }
     
    }

    public function forgotPassword(Request $request){
        $request->validate([
            'email' => ['required','email','exists:users'],
        ]);
        $user = User::where('email',$request->email)->first();

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);
        $name = $user->name;

        $mail = Mail::send('front_end.email_templates.forgot-password', ['token' => $token,'name'=>$name,'resetPsswordLink'=>route('user-reset.password.get',['token'=>$token]),'image' => asset('frontEnd/images/logo-dark.png')], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        $response = ['data' => [],"status"=>true ,"message" => "We have e-mailed your password reset link!"];
        return response($response, 200);
    }
}
