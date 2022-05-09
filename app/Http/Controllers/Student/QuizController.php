<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use App\Http\Requests\Students\SolveQuizRequest;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        $student  = auth()->guard('student')->user();
        $quizzes  = $student->quizzes()->active()->search()->latest()->paginate(10) ;
        foreach($quizzes as $quiz) 
        {
            $quiz->questions = $student->questions()->wherePivot('quiz_id' , $quiz->id)->get();
        }
        $subjects = Subject::get();
        return view('students.quizzes.index' , compact('quizzes' , 'subjects'));
    }

    public function start_quiz($id)
    {
        //1 check that student has access tio quiz
        $check_access = $this->check_student_has_access_to_quiz($id);
        if(!$check_access)
        {
            toastr()->error(__('quizzes.you_have_no_access_to_this_quiz'));
            return redirect()->route('student.quiz.index')->with('error' , __('quizzes.you_have_no_access_to_this_quiz') );
        }
        $student  = auth()->guard('student')->user();   
        $quiz = Quiz::findOrFail($id);
        
        //2 join the student with the quiz => pivot-> joined -> 1
        $student->quizzes()->updateExistingPivot(  $quiz->id , [
            'joined' => 1
        ]);
        //3 redirect student to quiestions page
        return redirect()->route('student.quiz.get_questions' , $id);
    }

    public function get_questions($quiz_id)
    {
        //1 check that student has access tio quiz
        $check_access = $this->check_student_has_access_to_quiz($quiz_id);
        if(!$check_access)
        {
            toastr()->error(__('quizzes.you_have_no_access_to_this_quiz'));
            return redirect()->route('student.quiz.index')->with('error' , __('quizzes.you_have_no_access_to_this_quiz') );
        }

        $quiz = Quiz::find($quiz_id);
        $questions = Question::where('quiz_id' , $quiz->id)->inRandomOrder()->get();
        foreach($questions as $question)
        {
            $question->choices = Choice::where('question_id' , $question->id)->select('id' , 'title' , 'question_id')->inRandomOrder()->get();
        }

        return view('students.quizzes.get_questions' , compact('quiz' , 'questions' ) );

    }

    public function solve_quiz(SolveQuizRequest $request , $id)
    {
        try {
            DB::beginTransaction();
            $check = $this->check_student_joined_quiz($id);
            if(!$check)
            {
                toastr()->error(__('quizzes.you_have_no_access_to_this_quiz'));
                return redirect()->route('student.quiz.index')->with('error' , __('quizzes.you_have_no_access_to_this_quiz') );
            }

            $student  = auth()->guard('student')->user();   
            $quiz = Quiz::find($id);
            //check answers
            $total_score = 0;
            foreach($request->choices as $choice_id)
            {
                $choice = Choice::findOrFail($choice_id);
                $question = $choice->question;

                $student->questions()->attach($choice->question_id , [
                    'quiz_id' => $id,
                    'choice_id' => $choice_id,
                    'correct' => $choice->correct,
                    'score' => $choice->correct ? $question->score : 0 ,
                    'answer' => $choice->title,
                ]);

                $total_score += $choice->correct ? $question->score : 0 ;
            }
            //update student quiz score
            $student->quizzes()->updateExistingPivot(  $quiz->id , [
                'score' => $total_score
            ]);

            DB::commit();
            toastr()->success(__('messages.answers_submitted_successfully'));
            return redirect()->route('student.quiz.index')->with('success' , __('messages.answers_submitted_successfully')     );
        }
        catch(\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->withInput()->with('error' , $e->getMessage());
        }
    }

    public function check_student_has_access_to_quiz($quiz_id)
    {
        $student  = auth()->guard('student')->user();   
        //1 check that quiz status is started and active
        $quiz = Quiz::active()->where('status' , 'started')->find($quiz_id);
        if(!$quiz)
        {
            return false;
        }
        //2 check that student has access to this quiz
        $quiz_student = $student->quizzes()->where('quizzes.id' , $quiz->id)->first();
        if(!$quiz_student)
        {
            return false;
        }
        //3 check that if student started this quiz before

        if($quiz_student->pivot->started)
        {
            return false;
        }

        return true;
    }

    public function check_student_joined_quiz($quiz_id)
    {
        $student  = auth()->guard('student')->user();   
        //1 check that quiz status is started and active
        $quiz = Quiz::active()->where('status' , 'started')->find($quiz_id);
        if(!$quiz)
        {
            return false;
        }
        //2 check that student has access to this quiz
        $quiz_student = $student->quizzes()->where('quizzes.id' , $quiz->id)->first();
        if(!$quiz_student)
        {
            return false;
        }
        //3 check that if student joined this quiz before
        if(!$quiz_student->pivot->joined)
        {
            return false;
        }

        //4 check that if student started this quiz before
        if($quiz_student->pivot->score)
        {
            return false;
        }
        /*if($quiz_student->pivot->started)
        {
            return false;
        }*/

        return true;
    }

    public static function change_started_quiz_status($quiz_id)
    {
        $student  = auth()->guard('student')->user();   

        $quiz = Quiz::active()->where('status' , 'started')->find($quiz_id);

        if($quiz)
        {
            $student->quizzes()->updateExistingPivot(  $quiz->id , [
                'started' => 1
            ]);
        }     
    }
}
