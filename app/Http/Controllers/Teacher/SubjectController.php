<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Student;
use App\Http\Requests\Teachers\SubjectAttachmentRequest;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    public function show($id)
    {
        $teacher = auth()->guard('teacher')->user();
        $subject = Subject::whereHas('teachers' , function($query) use($teacher) {

            $query->where('teachers.id' , $teacher->id);

        })->findOrFail($id);
        
        $attachments = $subject->attachments()->where('teacher_id' , $teacher->id)->latest()->paginate(15);

        $number_of_quizzes = $subject->quizzes()->where('teacher_id' , $teacher->id)->count();

        $number_of_students = Student::where('class_room_id' , $subject->class_room_id)->count();

        $number_of_attachments = $attachments->total();

        return view('teachers.subjects.show' , compact('subject' ,  'attachments' , 'number_of_quizzes' , 'number_of_students' , 'number_of_attachments'));
    }


    public function store_attachments(SubjectAttachmentRequest $request , $subject_id)
    {
        $teacher = auth()->guard('teacher')->user();
        $subject = Subject::whereHas('teachers' , function($query) use($teacher) {

            $query->where('teachers.id' , $teacher->id);

        })->findOrFail($subject_id);
      
        $subject->uploadAttachments($request->attachments ,  'subjects/subject_' . $subject_id ,  $request->description );

        toastr()->success(__('messages.added_successfully'));
        return redirect()->back(); 
    }

    public function update_attachment(Request $request , $id)
    {
        $teacher = auth()->guard('teacher')->user();

        $attachment = $teacher->subject_attachments()->where('attachments.id' , $id)->firstOrFail();

        $attachment->update([
            'description' => $request->description
        ]);

        toastr()->success(__('messages.updated_successfully'));
        return redirect()->back(); 
    }

    public function destroy_attachment($id)
    {
        $teacher = auth()->guard('teacher')->user();

        $attachment = $teacher->subject_attachments()->where('attachments.id' , $id)->firstOrFail();

        Storage::delete($attachment->path);
        $attachment->delete();
        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->back();

    }

    public function download_attachment($id)
    {
        try{

            $teacher = auth()->guard('teacher')->user();

            $attachment = $teacher->subject_attachments()->where('attachments.id' , $id)->firstOrFail();

            return Storage::download($attachment->path);
        }
        catch(\Exception $e) {
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
       
    }
}
