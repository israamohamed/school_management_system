<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\Teachers\QuizRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class QuizController extends Controller
{
  
    public function index()
    {
        $teacher  = auth()->guard('teacher')->user();
        $quizzes  = Quiz::where('teacher_id' , $teacher->id)->paginate();
        $subjects = $teacher->subjects;

        return view('teachers.quizzes.index' , compact('quizzes' , 'subjects'));
    }

  
    public function create()
    {
        $teacher                  = auth()->guard('teacher')->user();
        $educational_class_rooms  = $teacher->educational_class_rooms;
        $subjects                 = $teacher->subjects;

        return view('teachers.quizzes.create' , compact('educational_class_rooms' , 'subjects'));
    }

  
    public function store(QuizRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->merge([
                'active'     => $request->active ? true : false,
                'teacher_id' => auth()->guard('teacher')->user()->id,
            ]);
            //create new quiz
            $quiz = Quiz::create($request->all());
            //assign quiz to students
            $students_ids = Student::where('educational_class_room_id' , $quiz->educational_class_room_id )->pluck('id')->toArray();
            $quiz->students()->attach($students_ids);

            DB::commit();
            toastr()->success(__('messages.added_successfully'));
            return redirect()->route('teacher.quiz.index');
        }

        catch(\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
       
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $teacher                  = auth()->guard('teacher')->user();
        $quiz                     = Quiz::where('id' , $id)->where('teacher_id' , $teacher->id)->firstOrFail();
        
        $educational_class_rooms  = $teacher->educational_class_rooms;
        $subjects                 = $teacher->subjects;

        return view('teachers.quizzes.edit' , compact('quiz' , 'educational_class_rooms' , 'subjects'));
    }

   
    public function update(QuizRequest $request, $id)
    {
        $teacher                  = auth()->guard('teacher')->user();
        $quiz                     = Quiz::where('id' , $id)->where('teacher_id' , $teacher->id)->firstOrFail();

        try {
            DB::beginTransaction();

            $request->merge([
                'active'     => $request->active ? true : false,
                'teacher_id' => auth()->guard('teacher')->user()->id,
            ]);
            //update quiz data
            $quiz->update($request->all());

            DB::commit();
            toastr()->success(__('messages.updated_successfully'));
            return redirect()->route('teacher.quiz.index');
        }

        catch(\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
    }

 
    public function destroy($id)
    {
        $teacher                  = auth()->guard('teacher')->user();
        $quiz                     = Quiz::where('id' , $id)->where('teacher_id' , $teacher->id)->firstOrFail();
       
        $quiz->delete();
        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->back();
    }
}
