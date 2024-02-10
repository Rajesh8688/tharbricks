<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Lead;
use App\Models\User;
use App\Models\Service;
use App\Models\LeadUser;
use App\Models\Question;
use App\Models\LeadAnswer;
use App\Models\ServiceUser;
use Illuminate\Http\Request;
use App\Models\VendorDetails;
use App\Models\QuestionOption;
use App\Models\ResponseActivity;
use App\Models\NotInterestedLead;
use App\Http\Controllers\Controller;
use App\Models\CreditTransactionLog;

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

        try {
            $lead = new Lead();
            $lead->email = $email;
            $lead->service_id = $serviceId;
            $lead->phone = $phone;
            $lead->status = 'Active';
            $lead->name = $name;
            $lead->pin_code = $pin_code;
            $lead->address = $address;
            $lead->save();
            $lead->unique_id = 'L'.str_pad($lead->id, 8, '0', STR_PAD_LEFT);

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

            return redirect()->route('home')->with('success',$serviceDetails->name.' request submitted successfully');

        } catch (\Throwable $th) {
            return redirect()->route('home')->with('error','something went wrong');
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
                    $responseActivity->message = "Looking for a ".$leadDetails->name;
                    $responseActivity->logged_date = now();
                    $responseActivity->from = 'customer';
                    $responseActivity->status = "Active";
                    $responseActivity->save();

                    $responseActivity = new ResponseActivity();
                    $responseActivity->lead_user_id = $leadUser->id;
                    $responseActivity->message = "Purchased the Lead ";
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
        $leads = Lead::with('service')->where("status" , "InActive")->whereIn('service_id' ,$userServices);
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
            $lead->lead_added_on = $lead->created_at->diffForHumans(null,null,true);
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
        ->leftJoin("leads", 'lead_users.lead_id', '=', 'leads.id')
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
            $lead->responseActivities = ResponseActivity::where('lead_user_id' , $myleads[0]->leadUsersId)->orderBy('id','DESC')->get();
            $lastActivity = ResponseActivity::where('lead_user_id' , $myleads[0]->leadUsersId)->orderBy('id','DESC')->first();
            $lead->lastActivityDate = $lastActivity->logged_date;
            $lead->lastActivityMessage = $lastActivity->message;
            
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
                $leadAnswers = LeadAnswer::with('question')->where("lead_id" , $lead->id)->where("status" , "Active")->get();
                $lead->leadAnswers = $leadAnswers;
     
                $lead->responseActivities = ResponseActivity::where('lead_user_id' , $leadUser->id)->orderBy('id','DESC')->get();
                $lastActivity = ResponseActivity::where('lead_user_id' , $leadUser->id)->orderBy('id','DESC')->first();
                $lead->lastActivityDate = $lastActivity->logged_date;
                $lead->lastActivityMessage = $lastActivity->message;
                return response()->json([
                    'leadDetails' => view('front_end.vendor.vendor_response_details_view',compact('lead'))->render()
                ]);

            }else{
                return response()->json(['error' => "Don't have access to this lead"], 500);
            }
            

            
        }

    }
}
