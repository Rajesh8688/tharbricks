<?php

namespace App\Http\Controllers\Api;

use App\Models\Lead;
use App\Models\LeadUser;
use App\Models\Estimation;
use App\Models\LeadAnswer;
use App\Models\ServiceUser;
use App\Models\ResponseNote;
use Illuminate\Http\Request;
use App\Models\VendorDetails;
use App\Models\ResponseActivity;
use App\Models\NotInterestedLead;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CreditTransactionLog;
use Illuminate\Support\Facades\Validator;

class LeadController extends BaseApiController
{
    public function leads(Request $request)
    {
        $unInterestedLeads = NotInterestedLead::select('lead_id')->where(['user_id' => auth('api')->user()->id ,"status" => 'Active'])->get();
        $InterestedLeads = LeadUser::select('lead_id')->where(['user_id' => auth('api')->user()->id ,"status" => 'Active'])->get();
        $userServices = ServiceUser::select('service_id')->where(['user_id' => auth('api')->user()->id , "status" => 'Active'])->get();
        $leads = Lead::with('service')->where("status" , "Active")->whereIn('service_id' ,$userServices);
        if(!empty($unInterestedLeads)){
            $leads = $leads->whereNotIn('id',$unInterestedLeads);
        }
        if(!empty($InterestedLeads)){
            $leads = $leads->whereNotIn('id',$InterestedLeads);
        }

        $totalAvaiableLeads = count($leads->get());
        $page = $request->input('page') ?? 1;
        $leads = $leads->offset($page-1)->limit(self::API_PAGINATION)->get();

        $pagination = ['total_pages' => $totalAvaiableLeads,'current_page'=> $page,'next_page'=> ($totalAvaiableLeads > $page*self::API_PAGINATION) ? $page+1 : $page ];

        $information = ['totalAvaiableLeads' => $totalAvaiableLeads , 'userServices' => count($userServices)];
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
            $lead->required_credits = env('LEAD_CREDITS');
            $lead->professional_respond  = LeadUser::where(['lead_id' => $lead->id , 'status' => 'Active'])->count();
        }

        $response['data'] = ['leads' => $leads,'information' => $information ,'pagination' => $pagination];
        $response['status'] = true;
        $response['message'] = Self::SUCCESS_MSG;

        return response($response, 200);
    }

    public function leadDetails(Request $request){
        $leadId = null;

        $leadId = $request->has('lead_id') ? $request->input('lead_id') : null;
        

        if(empty($leadId)){
            return response()->json(['status' => false , "message" => __('lang.lead_id_required')], 200);
        }else{
            $lead = Lead::with('service')->find($leadId);
            if(empty($lead)){
                return response()->json(['status' => false, "message" => 'Lead Does not exist'], 200);
            }
            $email = explode("@",$lead->email);
            $lead->encrypted_email = "**********@".$email[1];
            $lead->encrypted_phone = "*******".substr ($lead->phone, -3);
            $lead->professional_respond  = LeadUser::where(['lead_id' => $lead->id , 'status' => 'Active'])->count();
            $leadAnswers = LeadAnswer::with('question')->where("lead_id" , $lead->id)->where("status" , "Active")->get();
            $lead->professional_respond  = LeadUser::where(['lead_id' => $lead->id , 'status' => 'Active'])->count();
            $lead->leadAnswers = $leadAnswers;
            $lead->required_credits = env('LEAD_CREDITS');
            return response(['data' => $lead , "status"=>true ,"message" => Self::SUCCESS_MSG], 200);
        }
    }

    public function notInterestedLead(Request $request){
        if($request->has('lead_id')){
            $lead_id = $request->input('lead_id');
            $user_id = auth('api')->user()->id;

            $notIntrested = NotInterestedLead::where(['lead_id' => $lead_id ,'user_id' => $user_id ,'status' => 'Active'])->count();
            

            if($notIntrested > 0){
                $response = ['message' => __('lang.lead_removed_successfully'),"status"=>true];
                return response($response, 200);
            }
            $notInterestedLead = new NotInterestedLead();
            $notInterestedLead->user_id = $user_id;
            $notInterestedLead->lead_id = $lead_id;
            $notInterestedLead->status = 'Active';
            $notInterestedLead->save();

            if($notInterestedLead){
                $response = ['message' => __('lang.lead_removed_successfully'),"status"=>true];
            }else{
                $response = ['message' => __('lang.something_went_wrong'),"status"=>false];
            }
        }else{
            $response = ['message' => __('lang.something_went_wrong'),"status"=>false];
        }
        return response($response, 200);
    }

    public function InterestedLead(Request $request){

        if($request->has('lead_id')){
            $lead_id = $request->input('lead_id');
            $user_id = auth('api')->user()->id;
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

                    $response = ['message' => __('lang.lead_purchased_successfully'),"status"=>true];
                }else{
                    $response = ['message' => __('lang.insufficient_credits'),"status"=>false];
                }
            }else{
                $response = ['message' => __('lang.something_went_wrong'),"status"=>false];
            }
        }else{
            $response = ['message' => __('lang.lead_id_required'),"status"=>false];
        }

        return response($response, 200);
    }

    // My Response
    public function myleads(Request $request){

        $status = null;

        if($request->has('status')){
            $status = $request->input('status');
        }
    

        $userId  = auth('api')->user()->id;

        $myleads = LeadUser::select('leads.*','services.name as service_name','lead_users.response_status','lead_users.id as leadUsersId')
        ->Join("leads", 'lead_users.lead_id', '=', 'leads.id')
        ->leftJoin("services", 'services.id', '=', 'leads.service_id')
        ->where(["user_id" => $userId, "lead_users.status" => "Active" ]);
        if(!empty($status))
        {
            $myleads = $myleads->where('response_status' , $status);
        }
        $myleads = $myleads->orderBy('lead_users.id', 'DESC');

        $totalAvaiableLeads = count($myleads->get());
        $page = $request->input('page') ?? 1;
        $myleads = $myleads->offset($page-1)->limit(self::API_PAGINATION)->get();
        $information['totalMyleads'] = count($myleads);
        $information['totalMyservices'] = count(ServiceUser::select('service_id')->where(['user_id' => $userId , "status" => 'Active'])->get());
        $pagination = ['total_pages' => $totalAvaiableLeads,'current_page'=> $page,'next_page'=> ($totalAvaiableLeads > $page*self::API_PAGINATION) ? $page+1 : $page ];


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
            $lead->lastActivityDate = $lastActivity->logged_date ?? null;
            $lead->lastActivityMessage = $lastActivity->message ?? null;
        }
        
        $response['data'] = ['leads' => $myleads,'information' => $information , 'pagination' => $pagination ];
        $response['status'] = true;
        $response['message'] = Self::SUCCESS_MSG;

        return response($response, 200);

    }

    //MyResponse Details

    public function responseDetails(Request $request){
        $leadId = null;
        $leadId = $request->has('lead_id') ? $request->input('lead_id') : null;
        if(empty($leadId)){
            return response()->json(['status' => false , "message" => __('lang.lead_id_required')], 200);
        }else{
            $lead = Lead::with('service')->find($leadId);
            if(empty($lead)){
                return response()->json(['status' => false , "message" => __('lang.lead_does_not_exist')], 200);
            }
            $leadUser = LeadUser::where(["user_id" => auth('api')->user()->id ,"lead_id" => $leadId ,"status" => "Active"])->first();

            if(!empty($leadUser)){
                $lead = Lead::with('service')->find($leadId);
                $leadAnswers = LeadAnswer::with('question')->where("lead_id" , $lead->id)->where("status" , "Active")->get();
                $lead->leadAnswers = $leadAnswers;
                $lead->response_status = $leadUser->response_status;
                $lead->days_ago =   str_replace('mos', 'mon',$leadUser->created_at->diffForHumans(null,null,true));
                $lead->credits = 0;
                $Logs= creditTransactionLog::where(['lead_id' => $lead->id,'status' => 'Active','user_id' => auth('api')->user()->id,'action' => 'subtracted'])->first();
                if(!empty($Logs)){
                    $lead->credits = $Logs->credits;
                }
                $lead->responseActivities = ResponseActivity::where('lead_user_id' , $leadUser->id)->orderBy('id','DESC')->get();
                $lastActivity = ResponseActivity::where('lead_user_id' , $leadUser->id)->orderBy('id','DESC')->first();
                $lead->notes = ResponseNote::where('response_id' , $leadUser->id)->orderBy('id','DESC')->get();
                $lead->lastActivityDate = $lastActivity->logged_date;
                $lead->lastActivityMessage = $lastActivity->message;
                return response(['data' => $lead , "status"=>true ,"message" => Self::SUCCESS_MSG], 200);
            }else{
                return response()->json(['status' => false , "message" => __('lang.you_dont_have_access_to_this_lead')], 200);
            }
            

            
        }
    }

    // Activity Log Store

    public function activityLogger(Request $request){
        $validator = Validator::make($request->all(), [
            'lead_id' => 'required',
            'message' => 'required'
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }
        $userId  = auth('api')->user()->id;
        $leadId = $request->input('lead_id');

        //checking lead User access
        $leadUser = LeadUser::where(['user_id' => $userId , 'lead_id' => $leadId , 'status' => 'Active'])->first();
        if($leadUser === null){
            return response()->json(['status' => false , "message" => 'Lead Does not Exist' , 'data' => []], 200);
        }

        $messageKey = $request->input('message');
        if(in_array($messageKey, ['no_answer' , 'left_voice_mail' , 'we_talked' , 'didnt_call' ,'sent_whatsapp_message' ,'sent_email'])){
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
                    break;  
                case 'send_email':
                    $message = "sent_email";
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

        $responseActivity = ResponseActivity::where(['lead_user_id' => $leadUser->id])->orderBy('id','DESC')->get();

        return response()->json(['status' => true , "message" => __('lang.updated_activity_log') , 'data' => $responseActivity], 200);
    }

    public function addestimation(Request $request){
        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'lead_id' => 'required'
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }
        $lead_id = $request->input('lead_id');
        $leadUser = LeadUser::where(['lead_id' => $lead_id , 'user_id' => auth('api')->user()->id ,'status' => 'Active'])->first();
        if($leadUser === null){
            return response()->json(['status' => false , "message" => __('lang.lead_does_not_exist') , 'data' => []], 200);
        }
        $estimation = new Estimation();
        $estimation->text = $request->input('text');
        $estimation->text = $request->input('text');
        $estimation->attachment = '';
        $estimation->save();

        //storing in logs
        $responseActivity = new ResponseActivity();
        $responseActivity->lead_user_id = $leadUser->id;
        $responseActivity->message = 'estimation_added';
        $responseActivity->save();

        //mail to triggred


        return response()->json(['status' => true , "message" => __('lang.estimation_added_successfully') ], 200);
    }

    public function addNotes(Request $request){
        $validator = Validator::make($request->all(), [
            'notes' => 'required',
            'lead_id' => 'required'
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }
        $LeadId = $request->input('lead_id');
        $leadUser = LeadUser::where(['lead_id' => $LeadId , 'user_id' => auth('api')->user()->id ,'status' => 'Active'])->first();
        if($leadUser === null){
            return response()->json(['status' => false , "message" => __('lang.lead_does_not_exist') , 'data' => []], 200);
        }
        $LeadUserId = $leadUser->id;
        $responseNotes = new ResponseNote();
        $responseNotes->notes = $request->input('notes');
        $responseNotes->response_id = $leadUser->id;
        $responseNotes->save();

        $responseNotes = ResponseNote::where(['response_id' => $request->input('lead_id')])->get();

        
        //storing in logs
        $responseActivityLog = new ResponseActivity();
        $responseActivityLog->lead_user_id = $LeadUserId;
        $responseActivityLog->message = 'notes_added';
        $responseActivityLog->logged_date = now();
        $responseActivityLog->save();

        $responseNotes = ResponseNote::where(['response_id' => $LeadUserId])->get();
        //$responseActivity = ResponseActivity::where(['lead_user_id' => $leadUser->id])->orderBy('id','DESC')->get();
        return response()->json([
            'status' => true , "message" => __('lang.notes_added_successfully') ,
            'data' => $responseNotes
        ]);
    }
    public function myActivity(Request $request){
        $this->validate($request, [
            'lead_id' => 'required'
        ]);
        $leadUser = LeadUser::where(['user_id' => auth('api')->user()->id,'lead_id' => $request->input('lead_id')])->first();
        if($leadUser === null){
            return response()->json(['status' => false , "message" => __('lang.lead_does_not_exist') , 'data' => []], 200);
        }
        $responseActivity = ResponseActivity::where(['lead_user_id' => $leadUser->id])->orderBy('id','DESC')->get();
        return response()->json(['status' => true , "message" => __('lang.updated_activity_log') , 'data' => $responseActivity], 200);
    }
}
