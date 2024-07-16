<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Otp;
use App\Models\Lead;
use App\Models\User;
use App\Models\Service;
use App\Models\LeadUser;
use App\Models\Question;
use App\Models\Estimation;
use App\Models\LeadAnswer;
use App\Models\EmailMailer;
use App\Models\ServiceUser;
use App\Models\Notification;
use App\Models\ResponseNote;
use Illuminate\Http\Request;
use App\Models\VendorDetails;
use App\Models\QuestionOption;
use App\Models\ResponseActivity;
use App\Models\NotInterestedLead;
use App\Models\ReviewLeadChecker;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CreditTransactionLog;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;

class LeadController extends Controller
{
    public function storeLead(Request $request){
        $userRequest = $request->input();
        $serviceId = $userRequest['service_id'];
        $serviceDetails = Service::find($serviceId);

        $email = $userRequest['email'];
        $phone = $userRequest['phone'];
        $name = $userRequest['name'];
        $pin_code = $userRequest['pin_code'];
        $address = $userRequest['address'];

        unset($userRequest['_token']);
        unset($userRequest['email']);
        unset($userRequest['phone']);
        unset($userRequest['name']);
        unset($userRequest['pin_code']);
        unset($userRequest['address']);
        unset($userRequest['service_id']);
        unset($userRequest['otp']);
        unset($userRequest['serverOtp']);
        

        try {
            $lead = new Lead();
            $lead->email = $email;
            $lead->service_id = $serviceId;
            $lead->phone = $phone;
            $lead->status = 'Active';
            $lead->name = $name;
            $lead->pin_code = $pin_code;
            $lead->address = $address;
            $lead->latitude = '40.712776';
            $lead->longitude = '-74.005974';
            $lead->save();
            $lead->unique_id = 'L'.str_pad($lead->id, 8, '0', STR_PAD_LEFT);
            $lead->save();
            foreach($userRequest as $key => $req ){

                $questionDeatils = Question::where("slug" ,$key)->first();
                $answersText = null ;
                $answers = null ;

                if($questionDeatils->type == "imageRadio" || $questionDeatils->type == "normalRadio" || $questionDeatils->type == "multiSelect"){
                    if(is_array($req)){
                        $answers = implode(",",$req);
                        $questionOptions = QuestionOption::whereIn('id',$req)->get();
                        foreach ($questionOptions as $option) {
                            $answersTextArray[] = $option->option_text ?? null;
                        }
                        $answersText = implode("," ,$answersTextArray);
                    }else{
                        $questionOption = QuestionOption::find($req);
                        $answers = $req;
                        $answersText = $questionOption->option_text ?? null;
                    }
                }else{
                    $answersText = $req;
                    $answers = $req;
                }


                $leadAnswers = new LeadAnswer();
                
                $leadAnswers->question_id = $questionDeatils->id;
                $leadAnswers->lead_id = $lead->id;
                $leadAnswers->answer = $answers;
                $leadAnswers->answer_text = $answersText;
                $leadAnswers->status = 'Active';
                $leadAnswers->save();
          
            }

            //storing push notification
      
            $users = DB::table('users as u')
                ->leftJoin('vendor_details as vd', 'vd.user_id', '=', 'u.id')
                ->leftJoin('service_users as su', 'su.user_id', '=', 'u.id')
                ->where('vd.is_new_leads_i_receive_push_notifications', 1)
                ->where('su.service_id', $serviceId)
                ->where('su.status', 'Active')
                ->where('u.status', 'Active')
                ->where(function ($query) {
                    $query->whereNotNull('u.fcm_token')
                          ->orWhere('u.fcm_token', '!=', '');
                })
                ->select('u.*')
                ->get();
                    //dd($users);

            if(count($users) > 0){
                foreach($users as $user){
                    $notification = new Notification();
                    $notification->user_id = $user->id;
                    $notification->lead_id = $lead->id;
                    $notification->message = 'in '.$address.'. They are Ready to hire now';
                    $notification->status = 'Active';
                    $notification->title = $name.' is looking for '.$serviceDetails->name;
                    $notification->save();
                }
            }
            //storing email templates
            $email = explode("@",$lead->email);
            $lead->service_name = Service::find($lead->service)->pluck('name');
            $lead->encrypted_email = "**********@".$email[1];
            $lead->encrypted_phone = "*******".substr ($lead->phone, -3);
            $lead->url = route('vendor-leads');
            $lead->leadAnswers = LeadAnswer::with('question')->where(['lead_id' => $lead->id])->get();

            $this->sendEmailtoUsers(['lead_details' => $lead]);

            return redirect()->route('home')->with('success',$serviceDetails->name.' request submitted successfully');

        } catch (\Throwable $th) {
            return redirect()->route('home')->with('error','something went wrong');
        }
    }


    public function emailChecker(){
        return view('front_end.email_templates.estimation');
        // $leadId = 9;
        // $lead = Lead::find($leadId);
        // $email = explode("@",$lead->email);
        // $lead->encrypted_email = "**********@".$email[1];
        // $lead->encrypted_phone = "*******".substr ($lead->phone, -3);
        // $lead->url = route('vendor-leads');
        // $lead->leadAnswers = LeadAnswer::with('question')->where(['lead_id' => $lead->id])->get();
        // return $this->sendEmailtoUsers(['lead_details' => $lead]);
      
    }



    public function sendEmailtoUsers($data){
        $leadDetails = $data['lead_details'];
        $users = DB::table('users as u')
        ->leftJoin('vendor_details as vd', 'vd.user_id', '=', 'u.id')
        ->leftJoin('service_users as su', 'su.user_id', '=', 'u.id')
        ->where('vd.is_new_lead_i_receive_email_notifications', 1)
        ->where('su.service_id', $leadDetails->service_id)
        ->where('su.status', 'Active')
        ->where('u.status', 'Active')
        ->select('u.*')
        ->get();
    

    if(count($users) > 0){
        foreach($users as $user){
            $emailMailer = new EmailMailer();
            $emailMailer->mail_from = env('MAIL_FROM_ADDRESS');
            $emailMailer->mail_from_name = env('MAIL_FROM_NAME');
            $emailMailer->mail_to = $user->email;
            $emailMailer->mail_to_name = $user->name;
            $emailMailer->reference = 'lead';
            $emailMailer->reference_id = $leadDetails->id;
            $emailMailer->mail_subject = $leadDetails->name . " is looking for " . $leadDetails->service_name;
            $emailMailer->mail_message = view('front_end.email_templates.lead',compact('leadDetails'))->render();
            $emailMailer->is_cron = '1';
            $emailMailer->cron_status = '0';
            $emailMailer->status = 'Active';
            $emailMailer->save();
        }
    }

    }

    public function notInterestedLead(Request $request){
        if($request->has('lead_id')){
            $lead_id = $request->input('lead_id');
            $user_id = auth('web')->user()->id;

            $notIntrested = NotInterestedLead::where(['lead_id' => $lead_id ,'user_id' => $user_id ,'status' => 'Active'])->get();

            if($notIntrested){
                return redirect()->back()->with('success', 'Lead removed successfully'); 
            }
            $notInterestedLead = new NotInterestedLead();
            $notInterestedLead->user_id = $user_id;
            $notInterestedLead->lead_id = $lead_id;
            $notInterestedLead->status = 'Active';
            $notInterestedLead->save();

            if($notInterestedLead){
                return redirect()->back()->with('success', 'Lead removed successfully'); 
            }else{
                return redirect()->back()->with('error', 'something went wrong');
            }
        }else{
            return redirect()->back()->with('error', 'something went wrong');
        }
    }

    public function InterestedLead(Request $request){
        if($request->has('lead_id')){
            $lead_id = $request->input('lead_id');
            $user_id = auth('web')->user()->id;
            $vendorDetails = VendorDetails::where("user_id" , $user_id)->first();
            $userLeads = LeadUser::where(["user_id" => $user_id , 'lead_id' => $lead_id ,'status' => 'Active'])->get();
            $leadCredits = 30;
          
            if(count($userLeads) == 0){
                if($vendorDetails->credits >= $leadCredits){

                    //Attaching leads to user
                    $leadUser = new LeadUser();
                    $leadUser->lead_id = $lead_id;
                    $leadUser->user_id = $user_id;
                    $leadUser->response_status = "Pending";
                    $leadUser->status = "Active";
                    $leadUser->save();

                    //CreditTransactionLog

                    $creditLogs = new CreditTransactionLog();
                    $vendorDetails = VendorDetails::where('user_id' , $user_id)->first();
                    $vendorCredits = $vendorDetails->credits;

                    $creditLogs->user_id = $user_id;
                    $creditLogs->lead_id = $lead_id;
                    $creditLogs->credits = $leadCredits;
                    $creditLogs->remaining_credits = $vendorCredits - $leadCredits;
                    $creditLogs->action = "subtracted";
                    $creditLogs->credits_description = $leadCredits." credits used to reply to customer";
                    $creditLogs->date_of_transaction = now();
                    $creditLogs->save();
                    $creditLogs->unique_id = 'CT'.str_pad($creditLogs->id, 8, '0', STR_PAD_LEFT);
                    $creditLogs->save();

                    //Vendor Credit Update
                    $vendorDetails->credits = $vendorCredits - $leadCredits;
                    $vendorDetails->save();

                    //LeadDetails
                    $leadDetails = Lead::find($lead_id);

                    //Adding Response Activitys

                    $responseActivity = new ResponseActivity();
                    $responseActivity->lead_user_id = $leadUser->id;
                    $responseActivity->message = "looking_for_a_name";
                    $responseActivity->wildcard = json_encode(['name'=>$leadDetails->name]);
                    $responseActivity->logged_date = now();
                    $responseActivity->from = 'customer';
                    $responseActivity->status = "Active";
                    $responseActivity->save();

                    $responseActivity = new ResponseActivity();
                    $responseActivity->lead_user_id = $leadUser->id;
                    $responseActivity->message = "purchased_the_lead";
                    $responseActivity->logged_date = now();
                    $responseActivity->from = 'vendor';
                    $responseActivity->status = "Active";
                    $responseActivity->save();


                    return redirect()->route('my-tharbricks')->with('success',' request submitted successfully');

                }else{
                    return redirect()->back()->with('error-alert', 'Insufficient Credits');
                }
            }else{
                return redirect()->back()->with('error-alert', 'Something went wrong');
            }
        }else{
            return redirect()->back()->with('error-alert', 'Please Select a valid Lead');
        }
    }

    public function leads(){
        $titles = [
            'title' => "Vendor Leads",
        ];
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
        $totalAvaiableLeads = count($leads->get());
        $leads =  $leads->get();
        $information = ['totalAvaiableLeads' => $totalAvaiableLeads , 'userServices' => count($userServices)];
        //$leads = Lead::with('service')->where("status" , "InActive")->get();
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
            $lead->lead_added_on =   str_replace('mos', 'mon', $lead->created_at->diffForHumans(null,null,true));
        }
        $lead = $firstLead;
        if($firstLead){
            $lead = Lead::with('service')->find($firstLead);
            $email = explode("@",$lead->email);
            $lead->encrypted_email = "**********@".$email[1];
            $lead->encrypted_phone = "*******".substr ($lead->phone, -3);
            $leadAnswers = LeadAnswer::with('question')->where("lead_id" , $lead->id)->where("status" , "Active")->get();
            $lead->leadAnswers = $leadAnswers;
        }
        return view('front_end.vendor.leads',compact('titles' ,'leads' ,'lead' ,'information'));
    }

    public function leadDetails(Request $request){
        $leadId = null;

        $leadId = $request->has('lead_id') ? $request->input('lead_id') : null;

        if(empty($leadId)){
            return response()->json(['error' => 'Lead Id Required'], 500);
        }else{
            $lead = Lead::with('service')->find($leadId);
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
        }
    }

    // My Response
    public function myleads(Request $request){
        $titles = [
            'title' => "Bringing you the best leads for your business",
        ];
        $myleads = LeadUser::select('leads.*','services.name as service_name','lead_users.response_status','lead_users.id as leadUsersId')
        ->Join("leads", 'lead_users.lead_id', '=', 'leads.id')
        ->leftJoin("services", 'services.id', '=', 'leads.service_id')
        ->where(["user_id" => auth('web')->user()->id , "lead_users.status" => "Active" ] )
        ->orderBy('lead_users.id', 'DESC')
        ->get();

        $information['totalMyleads'] = count($myleads);
        $information['totalMyservices'] = count(ServiceUser::select('service_id')->where(['user_id' => auth('web')->user()->id , "status" => 'Active'])->get());

        $lead = null ;

        foreach($myleads as $k=>$lead){
            $leadAnswers = LeadAnswer::where("lead_id" , $lead->id)->get();
            $LeadAns = [];
            foreach($leadAnswers as $leadAnswer)
            {
                $LeadAns[] = ucfirst($leadAnswer->answer_text);
            }
            $lead->leadAnswers = implode("|",$LeadAns);
            $lead->leadAnswersShort = substr($lead->leadAnswers,0,60).((strlen($lead->leadAnswers) > 60) ? "...":"");
            $lead->lead_added_on = $lead->created_at->diffForHumans(null,null,true);
            $lastActivity = ResponseActivity::where('lead_user_id' , $lead->leadUsersId)->orderBy('id','DESC')->first();
            $lead->lastActivityDate = $lastActivity->logged_date;
            $lead->lastActivityMessage = $lastActivity->message;
        }
        
       
        if(count($myleads) > 0){
            $lead = Lead::with('service')->find($myleads[0]->id);
            $leadAnswers = LeadAnswer::with('question')->where("lead_id" , $lead->id)->where("status" , "Active")->get();
            $lead->leadAnswers = $leadAnswers;
            $lead->responseActivities = ResponseActivity::where(['lead_user_id' => $myleads[0]->leadUsersId,'status' =>'Active'])->orderBy('id','DESC')->get();
            foreach($lead->responseActivities as $k=>$responseActivity){
                $lead->responseActivities[$k]->message = translator($responseActivity->message , $responseActivity->wildcards);
            }
      


            $lastActivity = ResponseActivity::where('lead_user_id' , $myleads[0]->leadUsersId)->orderBy('id','DESC')->first();
            $lead->lastActivityDate = $lastActivity->logged_date;
            $lead->lastActivityMessage = $lastActivity->message;
            $leadUser = LeadUser::where(['user_id' => auth('web')->user()->id , 'lead_id' => $lead->id])->first();
            $lead->lead_user_id = $leadUser->id;  
            $lead->response_status = $leadUser->response_status;   
            $lead->notes = ResponseNote::where(['response_id' => $leadUser->id])->orderBy('id','DESC')->get();
            //send,resend,dontShow,reviewSubmited
            $lead->reviewLink = "dontShow";
            if($lead->response_status == "Hired" || $lead->response_status == "Archived"){
                $reviewChecker = ReviewLeadChecker::where(['lead_id' => $lead->id , 'requested_user_id' => auth('web')->user()->id])->first();
                if(!empty($reviewChecker)){
                    $lead->reviewLink = "send";
                }elseif($reviewChecker != "Answered"){
                    $lead->reviewLink = "resend";
                }elseif($reviewChecker == "Answered"){
                    $lead->reviewLink = "reviewSubmited";
                }
            }
        }
 
        
        return view('front_end.vendor.my_leads',compact('titles' ,'myleads' ,'lead' ,'information'));
    }

    //MyResponse Details

    public function responseDetails(Request $request){
        $leadId = null;
        $leadId = $request->has('lead_id') ? $request->input('lead_id') : null;
        if(empty($leadId)){
            return response()->json(['error' => 'Lead Id Required'], 500);
        }else{
            $lead = Lead::with('service')->find($leadId);
            if(empty($lead)){
                return response()->json(['error' => 'Lead does not exist'], 500);
            }
            $leadUser = LeadUser::where(["user_id" => auth('web')->user()->id ,"lead_id" => $leadId ,"status" => "Active"])->first();

            if(!empty($leadUser)){
                $lead = Lead::with('service')->find($leadId);
                $lastActivity = ResponseActivity::where('lead_user_id' , $leadUser->id)->orderBy('id','DESC')->first();
                $leadAnswers = LeadAnswer::with('question')->where("lead_id" , $lead->id)->where("status" , "Active")->get();
                $lead->leadAnswers = $leadAnswers;
                $lead->responseActivities = ResponseActivity::where(['lead_user_id' => $leadUser->id,'status' =>'Active'])->orderBy('id','DESC')->get();
                foreach($lead->responseActivities as $k=>$responseActivity){
                    $lead->responseActivities[$k]->message = translator($responseActivity->message , $responseActivity->wildcards);
                }
                $lead->notes = ResponseNote::where(['response_id' => $leadUser->id])->orderBy('id','DESC')->get();
                $lead->lastActivityDate = $lastActivity->logged_date;
                $lead->lastActivityMessage = $lastActivity->message;
                $lead->lead_user_id = $leadUser->id;   
                $lead->response_status = $leadUser->response_status;
                $lead->notes = ResponseNote::where(['response_id' => $leadUser->id])->orderBy('id','DESC')->get();
                return response()->json([
                    'leadDetails' => view('front_end.ajax.response-details',compact('lead'))->render()
                ]);
            }else{
                return response()->json(['error' => "Don't have access to this lead"], 500);
            }
            

            
        }

    }


    public function sendNotification(){
        $rsp =sendNotification('dmVGKAU3SKSGbtydo2FjqJ:APA91bGGH30ld-AY82OFMwuvPbW5lof4UkUCe85rMDk377nmw_4DcL7QtttlTXJ5_NHcG4gbJrupG8phgBUuaS9X9xEHcLlBfG-6XS2frEOlpaeUEwRIWNAy5DIwfx6doYNWk1_7NVnH' ,[]);
        dd($rsp);
    }


    public function sendOtp(Request $request){
        $phone = $request->input('phone');

        // Example OTP generation (you might want to use a more secure method)
        $otp = rand(100000, 999999);

        // Logic to send the OTP via SMS
        // This example uses a hypothetical SMS gateway API
        // Replace this with your actual SMS gateway API call
        $message = "Your OTP code is: $otp";
        //$response = $this->sendSms( $message , '+91'.$phone);
        $response['status'] = 200;

        $otptable = new Otp();
        $otptable->number = $phone;
        $otptable->otp = $otp;
        $otptable->save();
        
        if ($response['status'] == 200) {
            return response()->json([
                'status' => 'success',
                'message' => 'OTP sent successfully!',
                'otp' => $otp,
                'id' => $otptable->id // In a real application, you wouldn't return the OTP
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to send OTP. Please try again.'
        ], 500);
    }

    public function activityLogger(Request $request){
       
        $this->validate($request, [
            'lead_id' => 'required',
            'message' => 'required'
        ]);
        $userId  = auth('web')->user()->id;
        $leadId = $request->input('lead_id');
        $messageKey = $request->input('message');

        $leadDetails = Lead::find($leadId);

        //checking lead User access
        $leadUser = LeadUser::where(['user_id' => $userId , 'lead_id' => $leadId , 'status' => 'Active'])->first();
        if($leadUser === null){
            return response()->json(['status' => false , "message" => 'Lead Does not Exist' , 'data' => []], 500);
        }
        if(in_array($messageKey, ['no_answer' , 'left_voice_mail' , 'we_talked' , 'didnt_call' ,'send_whats_app' ,'send_email'])){
            $openwhatsapp = false;
            $whatsapp = null;
            $openemail = false;
            $email = null;
            switch ($messageKey) {
                case 'no_answer':
                    $message = 'no_answer';
                    break;
                case 'left_voice_mail':
                    $message = 'left_voicemail';
                    break;
                case 'we_talked':
                    $message = 'we_talked';
                    break;
                case 'didnt_call':
                    $message = "didnt_call";
                    break;
                case 'send_whats_app':
                    $message = "sent_whatsapp_message";
                    $openwhatsapp = true;
                    $whatsapp = "+91".$leadDetails->phone;
                    break;  
                case 'send_email':
                    $message = "sent_email";
                    $openemail = true;
                    $email = $leadDetails->email;
                    break;        
                default:
                    $message = 'no_answer';
                    break;
            }
            $responseActivity = new ResponseActivity();
            $responseActivity->lead_user_id = $leadUser->id;
            $responseActivity->message = $message;
            $responseActivity->logged_date = now();
            $responseActivity->save();
        }
        $leadResponse = new Request(['lead_id' => $leadId]);
        $responseData = $this->responseDetails($leadResponse);
        return response()->json([
            'ajaxActivityLogger' => $this->activityLogs($leadUser->id),
            'message' => __('lang.log_updated_successfully'),
            'openwhatsapp' => $openwhatsapp,
            'whatsappNumber' => $whatsapp,
            'openemail' => $openemail,
            'email' => $email,
            'responseDetails' => json_decode($responseData->getContent(),true)['leadDetails']
        ]);
    
    }
    
    public function addEstimation(Request $request){
       
        $this->validate($request, [
            'estimationText' => 'required',
            'estimationattachment' => 'required',
            'lead_user_id' => 'required'
        ]);
        $LeadUserId = $request->input('lead_user_id');
        $leadUser = LeadUser::find($LeadUserId);
        if($leadUser === null){
            return response()->json(['status' => false , "message" => 'Lead Does not Exist' , 'data' => []], 200);
        }
        $attachment = $request->file('estimationattachment');
        $path = Estimation::$imagePath;

        if ($attachment != NULL) {
            $newFileName = time() . $attachment->getClientOriginalName();
            $attachment->move(public_path($path), $newFileName);
            $dbpath = $path.$newFileName;
        }
        $estimation = new Estimation();
        $estimation->text = $request->input('text');
        $estimation->attachment = $dbpath;
        $estimation->lead_user_id = $LeadUserId;
        $estimation->save();


        //send estimation through mail

        $this->sendEstimationmailtoUsers(['estimation' => $estimation]);        



        //storing in logs
        $responseActivityLog = new ResponseActivity();
        $responseActivityLog->lead_user_id = $LeadUserId;
        $responseActivityLog->message = 'estimation_added';
        $responseActivityLog->logged_date = now();
        $responseActivityLog->save();
    
        return response()->json([
            'status' => true , "message" => __('lang.estimation_added_successfully') ,
            'ajaxActivityLogger' => $this->activityLogs($LeadUserId)
        ]);
    }

    public function sendEstimationmailtoUsers($data){

        $leadUser = LeadUser::find($data['estimation']->lead_user_id);
        $lead = Lead::with('service')->find($leadUser->lead_id);
        $lead->vendorName = auth('web')->user()->name;
        $estimation = $data['estimation'];

        $lead->LeadAnswers = LeadAnswer::with('question')->where(['lead_id' => $leadUser->lead_id])->get();

        $emailMailer = new EmailMailer();
        $emailMailer->mail_from = env('MAIL_FROM_ADDRESS');
        $emailMailer->mail_from_name = env('MAIL_FROM_NAME');
        $emailMailer->mail_to = $lead->email;
        $emailMailer->mail_to_name = $lead->name;
        $emailMailer->reference = 'estimation';
        $emailMailer->reference_id = $estimation->id;
        $emailMailer->mail_subject = "Estimation for your ".$lead->service->name." by ".auth('web')->user()->name;
        $emailMailer->mail_message = view('front_end.email_templates.estimation' ,compact('lead' , 'estimation' ))->render();
        $emailMailer->is_cron = '1';
        $emailMailer->cron_status = '0';
        $emailMailer->status = 'Active';
        $emailMailer->save();
    }

    public function addNotes(Request $request){
        $this->validate($request, [
            'notes' => 'required',
            'lead_user_id' => 'required'
        ]);
        $LeadUserId = $request->input('lead_user_id');
        $leadUser = LeadUser::find($LeadUserId);
        if($leadUser === null){
            return response()->json(['status' => false , "message" => 'Lead Does not Exist' , 'data' => []], 200);
        }
        $responseNotes = new ResponseNote();
        $responseNotes->notes = $request->input('notes');
        $responseNotes->response_id = $request->input('lead_user_id');
        $responseNotes->save();

        $responseNotes = ResponseNote::where(['response_id' => $request->input('lead_user_id')])->get();

        
        //storing in logs
        $responseActivityLog = new ResponseActivity();
        $responseActivityLog->lead_user_id = $LeadUserId;
        $responseActivityLog->message = 'notes_added';
        $responseActivityLog->logged_date = now();
        $responseActivityLog->save();

        return response()->json([
            'status' => true , "message" => __('lang.notes_added_successfully') ,
            'ajaxActivityLogger' => $this->activityLogs($request->input('lead_user_id')),
            'ajaxnotes' => $this->notesLogs($request->input('lead_user_id'))
        ]);
    }

    public function activityLogs($responseId){
        //$responseId = $lead_user_id
        $leadUser = LeadUser::find($responseId);
        $responseActivitys = ResponseActivity::where(['lead_user_id' => $responseId,'status' =>'Active'])->orderBy('id','DESC')->get();
        foreach($responseActivitys as $k=>$responseActivity){
            $responseActivitys[$k]->message = translator($responseActivity->message , $responseActivity->wildcards);
        }        
        $lead = Lead::find($leadUser->lead_id);
        return view('front_end.ajax.activityLogger' , compact('responseActivitys','lead'))->render();
    }

    public function notesLogs($responseId){
        $leadUser = LeadUser::find($responseId);
        $responseNotes = ResponseNote::where(['response_id' => $responseId])->orderBy('id','DESC')->get();
        return view('front_end.ajax.notesLogs' , compact('responseNotes'))->render();
    }

    public function updateResponse(Request $request){

        $responseStatus = $request->input('response_status');
        $lead_id = $request->input('lead_id');
        $leadUser = LeadUser::where(['lead_id' => $lead_id , 'user_id' => auth('web')->user()->id ,'status' => 'Active'])->first();
        if($leadUser === null){
            return response()->json(['status' => false , "message" => 'Lead Does not Exist' , 'data' => []], 500);
        }
        if(in_array($responseStatus , ['Pending' , 'Hired' , 'Archived']) && !empty($lead_id)){
            //update the data
            $leadUser->response_status = $responseStatus;
            $leadUser->save();

            $responseActivityLog = new ResponseActivity();
            $responseActivityLog->lead_user_id = $leadUser->id;
            $responseActivityLog->message = 'Status Updated added';
            $responseActivityLog->logged_date = now();
            $responseActivityLog->save();
        }
        $leadResponse = new Request(['lead_id' => $lead_id]);
        $responseData = $this->responseDetails($leadResponse);
        return response()->json(['status' => true , "message" => 'Status Updated' , 'data' => json_decode($responseData->getContent(),true)['leadDetails'] ], 200);
    }

    public function requestReview(Request $request){
        $this->validate($request, [
            'lead_id' => 'required',
        ]);

        $leadId = $request->input('lead_id');
        $requesteduserId = auth('web')->user()->id;
        $leadDeatils = Lead::find($leadId);
        $reviewLeadChecker = ReviewLeadChecker::where(['lead_id' => $leadId , 'email' => $leadDeatils->email ,'requested_user_id' => auth('web')->user()->id])->get();

        $LeadUser = LeadUser::where(['lead_id' => $leadId , 'user_id' => auth('web')->user()->id])->first();
        if($reviewLeadChecker->count() > 0){
            $url = route('requestReview', ['token' => Crypt::encrypt($reviewLeadChecker[0]->id)]);
            $message = "Again Review requested to user";
            $request = "resend";
        }else{
            $reviewLeadChecker = new ReviewLeadChecker();
            $reviewLeadChecker->lead_id = $leadId;
            $reviewLeadChecker->email = $leadDeatils->email;
            $reviewLeadChecker->requested_user_id= $requesteduserId;
            $reviewLeadChecker->save();
            $url = route('requestReview', ['token' => Crypt::encrypt($reviewLeadChecker->id)]);
            $message = "Review requested to user";
            $request = "send";
            //sending email
        }

        $responseActivityLog = new ResponseActivity();
        $responseActivityLog->lead_user_id = $LeadUser->id;
        $responseActivityLog->message = $message;
        $responseActivityLog->logged_date = now();
        $responseActivityLog->save();
        $leadResponse = new Request(['lead_id' => $leadId]);
        $responseData = $this->responseDetails($leadResponse);
       
    
        $response = ["status" =>true ,"message" => $message , 'link'=>$url , 'request' =>$request ,'number' =>$leadDeatils->phone , 'responseDetails' => json_decode($responseData->getContent(),true)['leadDetails']];
     
        
        return response($response, 200);
    }


}
