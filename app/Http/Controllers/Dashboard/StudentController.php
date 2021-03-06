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
use App\Models\StudyFee;

use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
  
    public function index()
    {
        $students = Student::search()->paginate(20);
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
            $student->uploadImage($request->profile_picture , 'students' , 'profile_picture');
            //check system settings for adding automatically student invoices
            if(system_settings() && system_settings()->create_student_invoices_automatically  )
            {
                //add mandatory fees as invoices to student
                $study_fees = StudyFee::filterStudent($student->id)->mandatory()->get();
                foreach($study_fees as $study_fee)
                {
                    $student_invoice = $student->student_invoices()->create([
                                        'study_fee_id' => $study_fee->id,
                                        'invoice_date' => date("Y-m-d"),
                                        'final_total'  => $study_fee->amount,
                                        'total'        => $study_fee->amount,
                                        'notes'        => 'system automatically add this invoice',
                                    ]);

                    //Add to student transactions
                    $student_invoice->student_transactions()->create([
                        'student_id'       => $student->id,
                        'type'             => 'invoice',
                        'debit'            => $student_invoice->final_total,
                        'transaction_date' => $student_invoice->invoice_date,
                        'notes'            => __('messages.new_invoice_added_to_student' , ['name' => $study_fee->title]) ,
                    ]);
                }
                            
            }
                
            //success message
            toastr()->success(__('messages.added_successfully'));
            return redirect()->route('dashboard.student.index');
            
        }
     
        catch(\Exception $e) {
            toastr()->error($e->getMessage());
            return back()->withIput()->with('error' , $e->getMessage());
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
        $student = Student::withoutGlobalScope('enrolled_students')->with(['blood_type' , 'nationality' , 'relision' , 'student_parent' , 'class_room' , 'educational_class_room' , 'created_by' , 'attachments' , 'student_invoices' , 'student_transactions' , 'financial_bonds'])->findOrFail($id);

        $study_fees = StudyFee::filterStudent($student->id)->get();
        return view('dashboard.students.show' , compact('student' , 'study_fees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::withoutGlobalScope('enrolled_students')->findOrFail($id);

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
        $student = Student::withoutGlobalScope('enrolled_students')->findOrFail($id);

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
            $student->updateImage($request->profile_picture , 'students' , 'profile_picture');
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
        $student = Student::withoutGlobalScope('enrolled_students')->findOrFail($id);
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
        $student = Student::withoutGlobalScope('enrolled_students')->findOrFail($id);
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
