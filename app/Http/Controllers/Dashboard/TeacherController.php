<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Http\Requests\TeacherRequest;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
  
    public function index()
    {
        $teachers = Teacher::search()->paginate(20);
        $subjects = Subject::get();

        return view('dashboard.teachers.index' , compact('teachers' , 'subjects'));
    }

   
    public function create()
    {
        $subjects = Subject::get();
        return view('dashboard.teachers.create' , compact('subjects') );
    }

   
    public function store(teacherRequest $request)
    {
        $request->merge([
            'name' =>   [
                'en' => $request->name_en, 'ar' => $request->name_ar 
            ],         
            'active' => $request->active ? true : false,
        ]);

        try {
            //store teacher in db
            $teacher = Teacher::create($request->all());
            //uploads profile_picture
            $teacher->uploadProfilePicture($request->profile_picture , 'teachers');
            //add subjects to teacher
            if($request->filled('subjects') &&  count($request->subjects) > 0 )
            {
                $teacher->subjects()->attach($request->subjects);
            }
            //success message
            toastr()->success(__('messages.added_successfully'));
            return redirect()->route('dashboard.teacher.index');
            
        }
     
        catch(\Exception $e) {
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
    }

    public function show($id)
    {
        $teacher = Teacher::with(['subjects'])->findOrFail($id);

        return view('dashboard.teachers.show' , compact('teacher' , 'teacher'));
    }

    public function edit($id)
    {
        $teacher = Teacher::with('subjects:id,name')->findOrFail($id);
        $subjects = Subject::get();
    
        return view('dashboard.teachers.edit' , compact('teacher' , 'subjects') );
    }


    public function update(teacherRequest $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->merge([
            'name' =>   [
                'en' => $request->name_en, 'ar' => $request->name_ar 
            ],

            'active' => $request->active ? true : false,
        ]);

        $updated_data = $request->password ? $request->all() : $request->except(['password']);

        try {
            DB::beginTransaction();
            //update teacher in db
            $teacher->update($updated_data);
            //update profile_picture
            $teacher->updateProfilePicture($request->profile_picture , 'teachers');
            //update subjects to teacher
            $teacher->subjects()->sync($request->subjects);
            DB::commit();
            //success message
            toastr()->success(__('messages.updated_successfully'));
            return redirect()->route('dashboard.teacher.index');
            
        }
     
        catch(\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->deleteAttachments();
        $teacher->delete();
        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->route('dashboard.teacher.index');
    }

}
