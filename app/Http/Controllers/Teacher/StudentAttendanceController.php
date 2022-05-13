<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Models\EducationalStage;
use App\Models\ClassRoom;
use App\Models\EducationalClassRoom;
use App\Models\Student;
use App\Models\AbsenceReason;
use App\Http\Requests\StudentAttendanceRequest;
use Illuminate\Support\Facades\DB;

class StudentAttendanceController extends Controller
{
   
    public function index()
    {
        if(!request()->filled('attendance_date'))
        {
            request()->merge(['attendance_date' => date('Y-m-d')]);
        }

        if(!request()->filled('academic_year'))
        {
            request()->merge(['academic_year' => date('Y')]);
        }

        $educational_class_rooms = EducationalClassRoom::search()->withCount('students')->with(['attendances' => function($query){

            $query->where('attendance_date' , request()->attendance_date)
                    ->where('academic_year' , request()->academic_year);

        }])
        ->withCount(['attendances as attendants_number' => function($q){
            $q->where('attendance_status' , 1)
                ->where('attendance_date' , request()->attendance_date)
                ->where('academic_year' , request()->academic_year);
        } , 
        'attendances as absence_number' => function($q){
            $q->where('attendance_status' , 0)
                ->where('attendance_date' , request()->attendance_date)
                ->where('academic_year' , request()->academic_year);
        }
        ])
        ->paginate(15);

        $class_rooms = ClassRoom::with('educational_stage')->get();

        //return $educational_class_rooms;
        return view('teachers.student_attendances.index' , compact('educational_class_rooms' , 'class_rooms') );
    }

 
    public function create()
    {
        $educational_stages      = EducationalStage::get();
        $class_rooms             = ClassRoom::get();
        $educational_class_rooms = EducationalClassRoom::get();
        $absence_reasons         = AbsenceReason::get();

        $students = Student::with(['attendances' => function($query){

            $query->where(function($q){

                $q->where('educational_class_room_id' , request()->educational_class_room_id)
                    ->where('attendance_date' , request()->attendance_date)
                    ->where('academic_year' , request()->academic_year);
            });

        }])->where(function($q){

            $q->where('class_room_id' , request()->class_room_id);
        
           $q->where('educational_class_room_id' , request()->educational_class_room_id);
            

        })->get();

        return view('teachers.student_attendances.create' , compact('educational_stages' , 'class_rooms' , 'educational_class_rooms' , 'students' , 'absence_reasons'));
    }

  
    public function store(StudentAttendanceRequest $request)
    {
        //class_room_id , educational_class_room_id , academic_year , attedance_date
        //List of [ student_id , attedance_status , absence_reason_id ]
        try {
            
            if(!request()->filled('attendance_date'))
            {
                request()->merge(['attendance_date' => date('Y-m-d')]);
            }
    
            if(!request()->filled('academic_year'))
            {
                request()->merge(['academic_year' => date('Y')]);
            }
    
            DB::beginTransaction();

            foreach($request->students as $data)
            { 
                $student    = Student::findOrFail($data['student_id']);
                $attendance = $student->attendances()->where('attendance_date' , request()->attendance_date)
                                                    ->where('academic_year' ,  request()->academic_year )
                                                    ->where('class_room_id' ,  request()->class_room_id )
                                                    ->first();
                                         
                $attendance_status = null;
                if( isset($data['attendance_status']) )
                {
                    if( $data['attendance_status'] == 'attendant')
                    {
                        $attendance_status = true;
                    }
                    else 
                    {
                        $attendance_status = false;
                    }
                }
               
    
                if($attendance)
                {
                    $attendance->update([
                        'attendance_status'  => $attendance_status,
                        'absence_reason_id' => $attendance_status === false &&  isset($data['absence_reason_id']) ?  $data['absence_reason_id'] : null 
                    ]);
                }
                else 
                {
                    $student->attendances()->create([
                        'student_id'                => $student->id,
                        'academic_year'             => request()->academic_year,
                        'class_room_id'             => request()->class_room_id,
                        'educational_class_room_id' => request()->educational_class_room_id,
                        'attendance_date'           => request()->attendance_date,
                        'attendance_status'         => $attendance_status,
                        'absence_reason_id'         => $attendance_status === false &&  isset($data['absence_reason_id']) ?  $data['absence_reason_id'] : null,
                        'teacher_id'                => auth()->guard('teacher')->user()->id
                    ]);
                }
    
            }

            DB::commit();

            toastr()->success( __('messages.student_attendance_saved') );
            return redirect()->route('teacher.student_attendance.index')
                            ->with('success' , __('messages.student_attendance_saved')  );
        
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
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy($id)
    {
        //
    }
}
