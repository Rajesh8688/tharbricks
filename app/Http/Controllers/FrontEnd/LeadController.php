<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Lead;
use App\Models\Service;
use App\Models\Question;
use App\Models\LeadAnswer;
use Illuminate\Http\Request;
use App\Models\QuestionOption;
use App\Http\Controllers\Controller;

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
}
