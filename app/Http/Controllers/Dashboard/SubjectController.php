<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Requests\SubjectRequest;
use App\Models\EducationalStage;
use App\Models\ClassRoom;

class SubjectController extends Controller
{
  
    public function index()
    {
        $subjects = Subject::search()->paginate(30);
        $class_rooms = ClassRoom::get();
        return view('dashboard.subjects.index' , compact('subjects' , 'class_rooms'));
    }

   
    public function create()
    {
        $educational_stages = EducationalStage::get();

        return view('dashboard.subjects.create' , compact('educational_stages'));
    }

  
    public function store(SubjectRequest $request)
    {
        $request->merge([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'active'               => $request->active ? true : false,
            'main_subject'         => $request->main_subject ? true : false,
            'success_required'     => $request->success_required ? true : false,
            'shared_between_terms' => $request->shared_between_terms ? true : false,
        ]);

        $subject = Subject::create($request->all());
        toastr()->success(__('messages.added_successfully'));
        return redirect()->route('dashboard.subject.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $educational_stages = EducationalStage::get();

        return view('dashboard.subjects.edit' , compact('subject' , 'educational_stages'));
    }


    public function update(SubjectRequest $request, $id)
    {
        $request->validated();

        $request->merge([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'active' => $request->active ? true : false,
            'main_subject'         => $request->main_subject ? true : false,
            'success_required'     => $request->success_required ? true : false,
            'shared_between_terms' => $request->shared_between_terms ? true : false,
        ]);

        $subject = Subject::findOrFail($id);

        $subject->update($request->all());
        toastr()->success(__('messages.updated_successfully'));
        return redirect()->route('dashboard.subject.index');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        
        $subject->delete();
        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->route('dashboard.subject.index');  
    }

    public function delete_selected(Request $request)
    {
        $selected_rows = $request->selected_rows;
        if($selected_rows)
        {
            $selected_rows_ids = explode("," , $selected_rows);
            $subjects = Subject::whereIn('id' , $selected_rows_ids)->delete();
            toastr()->success(__('messages.deleted_successfully'));
            return redirect()->route('dashboard.subject.index');
        }
        else 
        {
            toastr()->error(__('messages.error_occured'));
            return redirect()->route('dashboard.subject.index');
        }
        
    }
}
