<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentUpgrade;
use App\Models\EducationalStage;
use App\Models\ClassRoom;
use App\Models\EducationalClassRoom;
use App\Models\Student;
use App\Http\Requests\StudentUpgradeRequest;
use Illuminate\Support\Facades\DB;

class StudentUpgradeController extends Controller
{
  
    public function index()
    {
        $student_upgrades = StudentUpgrade::with(['student' , 'previous_class_room'])->paginate(30);
        return view('dashboard.student_upgrades.index' , compact('student_upgrades'));
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

        $students = Student::where(function($query){

            $query->where('class_room_id' , request()->previous_class_room_id);

            if(request()->filled('previous_educational_class_room_id'))
            {
                $query->where('educational_class_room_id' , request()->previous_educational_class_room_id);
            }

        })->get();

        return view('dashboard.student_upgrades.create' , compact('educational_stages' , 'class_rooms' , 'educational_class_rooms' , 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentUpgradeRequest $request)
    {
        try {
            $selected_rows_ids = explode("," , $request->selected_rows);
            $next_educational_stage = EducationalStage::findOrFail($request->next_educational_stage_id);
            $next_class_room        = ClassRoom::findOrFail($request->next_class_room_id);
            $new_stage              = ' ' . $next_educational_stage->name . ' - ' . $next_class_room->name;

            $specify = $request->previous_educational_class_room_id ? false : true ;
            DB::beginTransaction();

            foreach($selected_rows_ids as $student_id) 
            {
                $student = Student::findOrFail($student_id);

                if($specify)
                {
                    $request->merge([
                        'previous_educational_class_room_id' => $student->educational_class_room_id
                    ]);
                }

                $student->student_upgrades()->create($request->all());
            }

            Student::whereIn('id' , $selected_rows_ids)
                    ->update([
                        'class_room_id'             => $request->next_class_room_id,
                        'educational_class_room_id' => $request->next_educational_class_room_id,
                    ]);

            DB::commit();

            toastr()->success( __('messages.students_upgraded_successfully') );
            return redirect()->route('dashboard.student_upgrade.index')
                            ->with('success' , __('messages.students_upgraded_successfully') . $new_stage  );
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
        $student_upgrade = StudentUpgrade::findOrFail($id);
        $student =  $student_upgrade->student;
        $student->update([
            'class_room_id'             => $student_upgrade->previous_class_room_id,
            'educational_class_room_id' => $student_upgrade->previous_educational_class_room_id,
        ]);

        $student_upgrade->delete();
        toastr()->success(__("messages.student_upgrade_returned_successfully"));
        return redirect()->back();
    }


    /** return to previous stage * */
    public function return_multiple_students(Request $request)
    {
        try {
        
            $selected_rows = $request->selected_rows;
            if($selected_rows)
            {
                $selected_rows_ids = explode("," , $selected_rows);
                
                DB::beginTransaction();

                $student_upgrades = StudentUpgrade::whereIn('id' , $selected_rows_ids)->get();
                foreach($student_upgrades as $student_upgrade)
                {
                    $student =  $student_upgrade->student;
                    $student->update([
                        'class_room_id'             => $student_upgrade->previous_class_room_id,
                        'educational_class_room_id' => $student_upgrade->previous_educational_class_room_id,
                    ]);
                }

                StudentUpgrade::whereIn('id' , $selected_rows_ids)->delete();

                DB::commit();

                toastr()->success(__("messages.student_upgrade_returned_successfully"));
                return redirect()->back();
            
            }
            else 
            {
                toastr()->error(__('messages.error_occured'));
                return redirect()->route('dashboard.class_room.index');
            }

        }
        catch(\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
    }
}
