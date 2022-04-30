<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Relision;
use App\Models\StudentParent;
use App\Models\EducationalStage;
use App\Models\ClassRoom;
use App\Http\Requests\StudentRequest;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
  
    public function index()
    {
        $students = Student::enrolled()->search()->paginate(20);
        $educational_stages = EducationalStage::get();
        $class_rooms = ClassRoom::where('educational_stage_id' , request()->educational_stage_id)->get();
        return view('dashboard.students.index' , compact('students' , 'educational_stages' ,'class_rooms'));
    }

   
    public function create()
    {
        $blood_types        = BloodType::get();
        $nationalities      = Nationality::get();
        $relisions          = Relision::get();
        $student_parents    = StudentParent::get();
        $educational_stages = EducationalStage::get();

        return view('dashboard.students.create' , compact('blood_types' , 'nationalities' , 'relisions' , 'student_parents' , 'educational_stages') );
    }

   
    public function store(StudentRequest $request)
    {
        $request->merge([
            'name' =>   [
                'en' => $request->name_en, 'ar' => $request->name_ar 
            ],

            'birth_place' => [
                'en' => $request->birth_place_en,'ar' => $request->birth_place_ar
            ],
            'active' => $request->active ? true : false,

            'user_id' => auth()->user()->id
        ]);

        try {
            //store student in db
            $student = Student::create($request->all());
            //upload attachments
            $student->uploadAttachments($request->attachments , 'students');
            //uploads profile_picture
            $student->uploadProfilePicture($request->profile_picture , 'students');
            //success message
            toastr()->success(__('messages.added_successfully'));
            return redirect()->route('dashboard.student.index');
            
        }
     
        catch(\Exception $e) {
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::with(['blood_type' , 'nationality' , 'relision' , 'student_parent' , 'class_room' , 'educational_class_room' , 'created_by' , 'attachments' , 'student_invoices' , 'student_transactions' , 'financial_bonds'])->findOrFail($id);
        return view('dashboard.students.show' , compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);

        $blood_types        = BloodType::get();
        $nationalities      = Nationality::get();
        $relisions          = Relision::get();
        $student_parents    = StudentParent::get();
        $educational_stages = EducationalStage::get();

        return view('dashboard.students.edit' , compact('student' , 'blood_types' , 'nationalities' , 'relisions' , 'student_parents' , 'educational_stages') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->merge([
            'name' =>   [
                'en' => $request->name_en, 'ar' => $request->name_ar 
            ],

            'birth_place' => [
                'en' => $request->birth_place_en,'ar' => $request->birth_place_ar
            ],
            'active' => $request->active ? true : false,
        ]);

        $updated_data = $request->password ? $request->all() : $request->except(['password']);

        try {
            //update student in db
            $student->update($updated_data);
            //update attachments
            $student->updateAttachments($request->attachments , 'students');
            //update profile_picture
            $student->updateProfilePicture($request->profile_picture , 'students');
            //success message
            toastr()->success(__('messages.updated_successfully'));
            return redirect()->route('dashboard.student.index');
            
        }
     
        catch(\Exception $e) {
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->deleteAttachments();
        $student->delete();
        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->route('dashboard.student.index');
    }

    public function store_attachments(Request $request , $id)
    {
        $request->validate([
            'attachments' => 'required|array',
            'attachments.*' => 'file',
        ]);
        $student = Student::findOrFail($id);
        $student->uploadAttachments($request->attachments , 'students');
        //success message
        toastr()->success(__('messages.added_successfully'));
        return redirect()->back();

    }

    public function delete_attachment($id)
    {      
        $attachment = Attachment::findOrFail($id);
        Storage::delete($attachment->path);
        $attachment->delete();
        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->back();
    }

    public function download_attachment($id)
    {
        try{

            $attachment = Attachment::findOrFail($id);

            return Storage::download($attachment->path);
        }
        catch(\Exception $e) {
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
       
    }
}
