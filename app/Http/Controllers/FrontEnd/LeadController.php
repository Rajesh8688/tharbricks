<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Lead;
use App\Models\Category;
use App\Models\Question;
use App\Models\LeadAnswer;
use Illuminate\Http\Request;
use App\Models\QuestionOption;
use App\Http\Controllers\Controller;

class LeadController extends Controller
{
    public function storeLead(Request $request){
        $userRequest = $request->input();

        $categoryId = $userRequest['category_id'];
        $categoryDetails = Category::find($categoryId);

        $email = $userRequest['email'];
        $phone = $userRequest['phone'];

        unset($userRequest['_token']);
        unset($userRequest['email']);
        unset($userRequest['phone']);
        unset($userRequest['category_id']);

        try {
            $lead = new Lead();
            $lead->email = $email;
            $lead->category_id = $categoryId;
            $lead->phone = $phone;
            $lead->status = 'Active';
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

            return redirect()->route('home')->with('success',$categoryDetails->name.' request submitted successfully');

        } catch (\Throwable $th) {
            return redirect()->route('home')->with('error','something went wrong');
        }
    }
}
