<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Student;
use App\Http\Requests\students\SubjectAttachmentRequest;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    public function show($id)
    {
        $student = auth()->guard('student')->user();
        $subject = Subject::where('class_room_id' , $student->class_room_id )->findOrFail($id);
        
        $attachments = $subject->attachments()->latest()->get();

        return view('students.subjects.show' , compact('subject' ,  'attachments'));
    }


  
    public function download_attachment($id)
    {
        try{

            $student = auth()->guard('student')->user();

            $attachment = $student->subject_attachments()->where('attachments.id' , $id)->firstOrFail();

            return Storage::download($attachment->path);
        }
        catch(\Exception $e) {
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
       
    }
}
