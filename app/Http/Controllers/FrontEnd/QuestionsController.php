<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    public function getQuestion(Request $request){

        $categoryId = $request->input('categoryId') ?? null;
        $questionId = null;

        if($request->has('questionId') && !empty($request->input('questionId'))){
            $questionId = $request->input('questionId');
            //$questionDetails = Question::find($questionId);
            //$categoryId = $questionDetails->category_id;
        }
        $isFirstQuestion = false;

        $questionDetails = [];

        if(!empty($categoryId)){
            //getting first question
            $questionId = Question::where('category_id',$categoryId)->orderBy('order','asc')->limit(1)->first();
            //dd($questionId);
            if(!empty($questionId)){
                $questionDetails = Question::with('options')->find($questionId->id);
                $isFirstQuestion = true;
            }
        }elseif(!empty($questionId)){
            $questionDetails = Question::with('options')->find($questionId);
            
        }


        return response()->json(['success' => 'Question' ,'data' =>$questionDetails , 'isFirstQuestion' => $isFirstQuestion], 200);
    }
}
