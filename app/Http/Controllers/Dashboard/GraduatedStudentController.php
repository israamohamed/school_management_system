<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GraduatedStudent;
use App\Models\EducationalStage;
use App\Models\ClassRoom;
use App\Models\EducationalClassRoom;
use App\Models\Student;
use App\Http\Requests\GraduatedStudentRequest;
use Illuminate\Support\Facades\DB;

class GraduatedStudentController extends Controller
{
  
    public function index()
    {
        $graduated_students = GraduatedStudent::paginate(30);
        return view('dashboard.graduated_students.index' , compact('graduated_students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $educational_stages = EducationalStage::get();
        $class_rooms        = ClassRoom::get();
        $educational_class_rooms = EducationalClassRoom::get();

        $students = Student::enrolled()->where(function($query){

            $query->where('class_room_id' , request()->previous_class_room_id);

            if(request()->filled('previous_educational_class_room_id'))
            {
                $query->where('educational_class_room_id' , request()->previous_educational_class_room_id);
            }

        })->get();

        return view('dashboard.graduated_students.create' , compact('educational_stages' , 'class_rooms' , 'educational_class_rooms' , 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GraduatedStudentRequest $request)
    {
        try {
            $selected_rows_ids = explode("," , $request->selected_rows);
            
            $specify = $request->previous_educational_class_room_id ? false : true ;
            DB::beginTransaction();

            foreach($selected_rows_ids as $student_id) 
            {
                $student = Student::enrolled()->findOrFail($student_id);

                if(count($student->graduated_students) > 0)
                {
                    toastr()->error(__('messages.error_occured'));
                    return redirect()->back();
                }

                if($specify)
                {
                    $request->merge([
                        'previous_educational_class_room_id' => $student->educational_class_room_id
                    ]);
                }

                $student->graduated_students()->create($request->all());
            }

            Student::whereIn('id' , $selected_rows_ids)
                    ->update([
                        'status' => 'graduated'
                    ]);

            DB::commit();

            toastr()->success( __('messages.students_graduated_successfully') );
            return redirect()->route('dashboard.graduated_student.index')
                            ->with('success' , __('messages.students_graduated_successfully')  );
        }

        catch(\Exception $e) {
            DB::rollBack();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /** return to previous stage * */
    public function destroy($id)
    {
        $graduated_student = GraduatedStudent::findOrFail($id);
        $student =  $graduated_student->student;
        $student->update([
            'status' => 'enrolled'
        ]);

        $graduated_student->delete();
        toastr()->success(__("messages.graduated_student_returned_successfully"));
        return redirect()->back();
    }


    /** return to enrolled * */
    public function return_multiple_students(Request $request)
    {
        try {
        
            $selected_rows = $request->selected_rows;
            if($selected_rows)
            {
                $selected_rows_ids = explode("," , $selected_rows);
                
                DB::beginTransaction();

                $graduated_students = GraduatedStudent::whereIn('id' , $selected_rows_ids)->get();
                foreach($graduated_students as $graduated_student)
                {
                    $student =  $graduated_student->student;
                    $student->update([
                        'status' => 'enrolled'
                    ]);
                }

                GraduatedStudent::whereIn('id' , $selected_rows_ids)->delete();

                DB::commit();

                toastr()->success(__("messages.graduated_student_returned_successfully"));
                return redirect()->back();
            
            }
            else 
            {
                toastr()->error(__('messages.error_occured'));
                return redirect()->back();
            }

        }
        catch(\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
    }
}
