<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionOption;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $titles = ['title' => 'Manage Questions', 'subTitle' => 'Add Question', 'listTitle' => 'Question List'];
        $deleteRouteName = "question.destroy";

        if (!auth()->user()->can('question-view')) {
            return view('admin.abort', compact('titles'));
        }
        
        $categoryId = null ;
        if($request->has('category_id'))
        {
            $categoryId = $request->input('category_id');
        }
        $questions = Question::with('category');

        if(!empty($categoryId)){
            $questions = $questions->where('category_id' , $categoryId );
        }
        
        $questions = $questions->get();

        return view('admin.question.index', compact('titles', 'questions', 'deleteRouteName'));
    }

    public function getCategoryQuestions(Request $request){

        $categoryId = $request->input('category_id');
        $questionId = null;
        if($request->has('question_id')){
            $questionId = $request->input('question_id');
        }
        // Logic to fetch updated options based on $selectedValue
        $questions = Question::where('category_id', $categoryId);
        if(!empty($questionId)){
                $question = $questions->whereNotIn('id',[$questionId]);
        }
        $question = $questions->pluck('question_text', 'id');

        return response()->json(['options' => $question]);

    }

    public function create()
    {
       
        $titles = [
            'title' => "Question",
            'subTitle' => "Add Question",
        ];
        if (!auth()->user()->can('question-add')) {
            return view('admin.abort',compact('titles'));
        }

        $categories = Category::get();

        return view('admin.question.create', compact('titles' ,'categories'));
        
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('question-add')) {
            return view('admin.abort');
        }

        $this->validate($request, [
            'question_text' => 'required',
            'status' => 'required',
            'order' => 'required',
            'type' => 'required'
        ]);

        $question = new Question();

        $question->question_text = $request->input('question_text');
        $question->status = $request->input('status');
        $question->order = $request->input('order');
        $question->type = $request->input('type');
        $question->category_id = $request->input('category_id');
        $question->next_question_id =  $request->input('next_question_id') ;
        $question->slug =  unique_slug($request->input('question_text'), 'Question');

        $question->save();

        if($request->input('type') == 'imageRadio'){

            $questionOptions = $request->input('question_option_ir_text');
            $question_option_ir_next_question_id = $request->input('question_option_ir_next_question_id') ?? [];
            
            $questionImage = $request->file('question_image');

            foreach($questionOptions as $k=>$inputquestionOption )
            {
                $originalImage = $questionImage[$k];

                $questionOption = new QuestionOption();

                $newFileName = imagenameMaker(pathinfo($originalImage->getClientOriginalName(), PATHINFO_FILENAME) ,$originalImage->getClientOriginalExtension());

                $questionOptionPath = QuestionOption::$questionOptionPath;
                if($originalImage->getClientOriginalExtension() == 'svg')
                {
                    //$newFileName = time().$originalImage->getClientOriginalName();
                    $destinationPath = env('SVG_IMAGE_UPLOAD_PATH' , public_path()).$questionOptionPath;
                    $originalImage->move($destinationPath, $newFileName);
                }
                else{
                    // Image Upload Process
                    $thumbnailImage = Image::make($originalImage);
                    $thumbnailImage->save($questionOptionPath . $newFileName);
                }
                $questionOption->question_id = $question->id;
                $questionOption->option_text = $inputquestionOption;
                $questionOption->image = $newFileName;
                $questionOption->status = 'Active';
                $questionOption->next_question_id = (!empty($question_option_ir_next_question_id[$k])) ? $question_option_ir_next_question_id[$k] : null;
                $questionOption->save();
            }
        }elseif($request->input('type') == 'normalRadio'){
            $questionOptions = array_values($request->input('question_option_nr_text'));
            $question_option_nr_next_question_id = $request->input('question_option_nr_next_question_id') ?? [];
            foreach($questionOptions as $nr => $inputquestionOption){
                $questionOption = new QuestionOption();
                $questionOption->question_id = $question->id;
                $questionOption->option_text = $inputquestionOption;
                $questionOption->image = null;
                $questionOption->status = 'Active';
                $questionOption->next_question_id = (!empty($question_option_nr_next_question_id[$nr])) ? $question_option_nr_next_question_id[$nr] : null;
                $questionOption->save();
            }
            
        }elseif($request->input('type') == 'multiSelect'){

            $questionOptions = array_values($request->input('question_option_ms_text'));
            $question_option_ms_next_question_id = $request->input('question_option_ms_next_question_id') ?? [];
            foreach($questionOptions as $ms => $inputquestionOption){
                $questionOption = new QuestionOption();
                $questionOption->question_id = $question->id;
                $questionOption->option_text = $inputquestionOption;
                $questionOption->image = null;
                $questionOption->status = 'Active';
                $questionOption->next_question_id = (!empty($question_option_ms_next_question_id[$ms])) ? $question_option_ms_next_question_id[$ms] : null;
                $questionOption->save();
            }  
        }
        // elseif($request->input('type') == 'decisionMaking'){
        //     $questionOptions = array_values($request->input('question_option_dm_text'));
        //     $question_option_next_question_id = array_values($request->input('question_option_next_question_id'));
        //     foreach($questionOptions as $k=>$inputquestionOption){
        //         $questionOption = new QuestionOption();
        //         $questionOption->question_id = $question->id;
        //         $questionOption->option_text = $inputquestionOption;
        //         $questionOption->image = null;
        //         $questionOption->next_question_id = (!empty($question_option_next_question_id[$k])) ? $question_option_next_question_id[$k] : null;
        //         $questionOption->status = 'Active';
        //         $questionOption->save();
        //     }
        // }
       
        return redirect()->route('question.index')->with('success','Question created Successfully');
    }

    public function edit($id)
    {
        $titles = ['title' => 'Manage Question', 'subTitle' => 'Edit Question', 'listTitle' => 'Question List'];
        if (!auth()->user()->can('question-update')) {
            return view('admin.abort', compact('titles'));
        }

        $question = Question::find($id);

        $questionOptions = QuestionOption::where('question_id' , $id)->get();

        $categoryQuestions = Question::where('category_id' , $question->category_id)->whereNotIn('id' ,[$question->id])->get();

        $categories = Category::get();


        return view('admin.question.edit', compact('titles', 'categories' ,'questionOptions' ,'question','categoryQuestions'));
    }

    public function update(Request $request, $id)
    {

        if (!auth()->user()->can('question-update')) {
            return view('admin.abort');
        }
        
        $question = Question::find($id);
        $question->question_text = $request->input('question_text');
        $question->status = $request->input('status');
        $question->order = $request->input('order');
        $question->type = $request->input('type');
        $question->category_id = $request->input('category_id');
        $question->slug = unique_slug($request->input('question_text'), 'Question' , $question->id);
        $question->save();
        $questionOptionId = [];
        if($request->input('type') == 'imageRadio'){
            $question_option_ir_id = $request->input('question_option_ir_id');
            $question_image = $request->file('question_image');
            $question_option_ir_text = $request->input('question_option_ir_text');
            $question_option_ir_next_question_id = $request->input('question_option_ir_next_question_id');
            $questionOptionPath = QuestionOption::$questionOptionPath;

            foreach($question_option_ir_text as $irk=>$irv){
                if(!empty($question_option_ir_id[$irk])){
                    //update
                    $questionOption = QuestionOption::find($question_option_ir_id[$irk]);
                    if(!empty($question_image[$irk]))
                    {
                        $originalImage = $question_image[$irk];
                        
                        deleteImage($questionOptionPath, $questionOption->image);

                        $newFileName = imagenameMaker(pathinfo($originalImage->getClientOriginalName(), PATHINFO_FILENAME) ,$originalImage->getClientOriginalExtension());

                        if($originalImage->getClientOriginalExtension() == 'svg')
                        {
                            //$newFileName = time().$originalImage->getClientOriginalName();
                            $destinationPath = env('SVG_IMAGE_UPLOAD_PATH' , public_path()).$questionOptionPath;
                            $originalImage->move($destinationPath, $newFileName);
                        }
                        else{
                            // Image Upload Process
                            $thumbnailImage = Image::make($originalImage);
                            $thumbnailImage->save($questionOptionPath . $newFileName);
                        }
                        
                    }else{
                        $newFileName = $questionOption->image;
                    }
                    $questionOptionId[] = $questionOption->id;
                }else{
                    //add
                    $originalImage = $question_image[$irk];
                    $newFileName = imagenameMaker(pathinfo($originalImage->getClientOriginalName(), PATHINFO_FILENAME) ,$originalImage->getClientOriginalExtension());

                    if($originalImage->getClientOriginalExtension() == 'svg')
                    {
                        //$newFileName = time().$originalImage->getClientOriginalName();
                        $destinationPath = env('SVG_IMAGE_UPLOAD_PATH' , public_path()).$questionOptionPath;
                        $originalImage->move($destinationPath, $newFileName);
                    }
                    else{
                        // Image Upload Process
                        $thumbnailImage = Image::make($originalImage);
                        $thumbnailImage->save($questionOptionPath . $newFileName);
                    }

                    $questionOption = new QuestionOption();

                   
                    $questionOptionId[] = $questionOption->id;

                }

                $questionOption->option_text = $question_option_ir_text[$irk];
                $questionOption->next_question_id = (!empty($question_option_ir_next_question_id[$irk])) ? $question_option_ir_next_question_id[$irk] : null;;
                $questionOption->image = $newFileName;
                $questionOption->status = 'Active';
                $questionOption->question_id = $question->id;
                $questionOption->save();
            }
        }elseif($request->input('type') == 'normalRadio'){
            $question_option_nr_id = $request->input('question_option_nr_id');
            $question_option_nr_text = $request->input('question_option_nr_text');
            $question_option_nr_next_question_id = $request->input('question_option_nr_next_question_id');

            foreach($question_option_nr_text as $nrk => $nrv){
                if(!empty($question_option_nr_id[$nrk])){
                    //update
                    $questionOption = QuestionOption::find($question_option_nr_id[$nrk]);
                }else{
                    //add
                    $questionOption = new QuestionOption();
                }
                $questionOption->next_question_id = (!empty($question_option_nr_next_question_id[$nrk])) ? $question_option_nr_next_question_id[$nrk] : null;
                $questionOption->option_text = $question_option_nr_text[$nrk];
                $questionOption->status = 'Active';
                $questionOption->question_id = $question->id;
                $questionOption->save();

                $questionOptionId[] = $questionOption->id;
            }
        }elseif($request->input('type') == 'multiSelect'){
            $question_option_ms_id = $request->input('question_option_ms_id');
            $question_option_ms_text = $request->input('question_option_ms_text');
            $question_option_ms_next_question_id = $request->input('question_option_ms_next_question_id');

            foreach($question_option_ms_text as $msk => $msv){
                if(!empty($question_option_ms_id[$msk])){
                    //update
                    $questionOption = QuestionOption::find($question_option_ms_id[$msk]);
                }else{
                    //add
                    $questionOption = new QuestionOption();
                }
                $questionOption->next_question_id = (!empty($question_option_ms_next_question_id[$msk])) ? $question_option_ms_next_question_id[$msk] : null;
                $questionOption->option_text = $question_option_ms_text[$msk];
                $questionOption->status = 'Active';
                $questionOption->question_id = $question->id;
                $questionOption->save();
                $questionOptionId[] = $questionOption->id;
            }
        }elseif($request->input('type') == 'decisionMaking'){
            $question_option_dm_id = $request->input('question_option_dm_id');
            $question_option_dm_text = $request->input('question_option_dm_text');
            $question_option_next_question_id = $request->input('question_option_next_question_id');

            foreach($question_option_dm_text as $dmk => $dmv){
                if(!empty($question_option_dm_id[$dmk])){
                    //update
                    $questionOption = QuestionOption::find($question_option_dm_id[$dmk]);
                    
                }else{
                    //add
                    $questionOption = new QuestionOption();
                }
                
                $questionOption->option_text = $question_option_dm_text[$dmk];
                $questionOption->status = 'Active';
                $questionOption->question_id = $question->id;
                $questionOption->next_question_id = (!empty($question_option_next_question_id[$dmk])) ? $question_option_next_question_id[$dmk] : null;
                $questionOption->save();
                $questionOptionId[] = $questionOption->id;
            }
        }
        $qq = QuestionOption::whereNotIn('id' , $questionOptionId)->where("question_id" , $question->id)->delete();


        return redirect()->route('question.index')->with('success', 'Updated Successfully');

    }
}
