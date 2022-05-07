<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;
use App\Http\Requests\Teachers\StoreQuestionRequest;
use App\Http\Requests\Teachers\UpdateQuestionRequest;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
   
    public function index()
    {
        $teacher  = auth()->guard('teacher')->user();
        $quiz     = Quiz::where('teacher_id' , $teacher->id)
                            ->where('quiz_id' , request()->quiz_id)
                            ->firstOrFail();

        $questions = Question::where('quiz_id' , request()->quiz_id)->get();
        return view('teachers.questions.index' , compact('questions'));
    }

  
    public function create()
    {
        $teacher  = auth()->guard('teacher')->user();
        $quiz     = Quiz::where('teacher_id' , $teacher->id)
                            ->where('id' , request()->quiz_id)
                            ->firstOrFail();
        return view('teachers.quizzes.questions.create' , compact('quiz'));
    }

   
    public function store(StoreQuestionRequest $request)
    {
        try {
            $teacher  = auth()->guard('teacher')->user();
            $quiz     = Quiz::where('teacher_id' , $teacher->id)
                                ->where('id' , $request->quiz_id)
                                ->firstOrFail();
    
            DB::beginTransaction();

            foreach($request->questions as $question_data)
            {
                $question_data = (object) $question_data ;
                //1 - store question
                $question = $quiz->questions()->create([
                    'title' => $question_data->title,
                    'score' => $question_data->score,
                ]);
                //store correct choice
                $question->choices()->create([
                    'title'   => $question_data->correct_choice,
                    'correct' => 1,
                ]);
                //store wrong choices
                foreach($question_data->wrong_choices as $wrong_choice)
                {
                    $question->choices()->create([
                        'title'   => $wrong_choice,
                        'correct' => 0,
                    ]);
                }
            }

            DB::commit();
            toastr()->success(__('messages.added_successfully'));
            return redirect()->route('teacher.quiz.show' , $quiz->id);
        }

        catch(\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->withInput()->with('error' , $e->getMessage());
        }
        
    }

   
    public function show($id)
    {
        //
    }

 
    public function edit($id)
    {
        //
    }

 
    public function update(UpdateQuestionRequest $request, $id)
    {
        try {
            $teacher  = auth()->guard('teacher')->user();
            $quiz     = Quiz::where('teacher_id' , $teacher->id)
                                ->where('id' , $request->quiz_id)
                                ->firstOrFail();

            DB::beginTransaction();

            $question = Question::findOrFail($id);
            //update the question data
            $question->update($request->all());
            //update correct choice
            $correct_choice = $question->choices()->where('correct' , 1)->first();
            if($correct_choice)
            {
                $correct_choice->update(['title' => $request->correct_choice]);
            }
            //update wrong choices

            //will old choices that not exist in the reqest delete
            $question->choices()->where('correct' , 0)->whereNotIn('title' , $request->wrong_choices)->delete();
            
            foreach($request->wrong_choices as $wrong_choice)
            {
                $choice = $question->choices()->where('correct' , 0)->where('title' , $wrong_choice)->first();
                if(!$choice)
                {
                    $question->choices()->create([
                        'title'   => $wrong_choice,
                        'correct' => 0,
                    ]);
                }
                
            }

            DB::commit();
            toastr()->success(__('messages.updated_successfully'));
            return redirect()->route('teacher.quiz.show' , $quiz->id);
        }

        catch(\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->withInput()->with('error' , $e->getMessage());
        }
    }

    
    public function destroy($id)
    {
        $teacher  = auth()->guard('teacher')->user();
        $question = Question::whereIn('quiz_id' ,  $teacher->quizzes->pluck('id')->toArray() )->findOrFail($id);
        
        $question->delete();

        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->back();
    }
}
