<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsenceReason;

use App\Http\Requests\AbsenceReasonRequest;

class AbsenceReasonController extends Controller
{
  
    public function index()
    {
        $absence_reasons = AbsenceReason::paginate(10);
        return view('dashboard.absence_reasons.index' , compact('absence_reasons'));
    }

  
    public function create()
    {
        //
    }

  
    public function store(AbsenceReasonRequest $request)
    {
        $request->merge([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ]
        ]);

        $absence_reason = AbsenceReason::create($request->all());
        toastr()->success(__('messages.added_successfully'));
        return redirect()->route('dashboard.absence_reason.index');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

  
    public function update(AbsenceReasonRequest $request, $id)
    {
        $request->merge([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ]
        ]);

        $absence_reason = AbsenceReason::findOrFail($id);
        $old_object = $absence_reason;

        $absence_reason->update($request->all());

        /*activity()
            ->performedOn($absence_reason)
            ->causedBy(auth()->user())
            ->withProperties(['old_name_en' => $old_object->getTranslation('name' , 'en') , 'new_name_en' => $absence_reason->getTranslation('name' , 'en')])
            ->log('Absence Reason changed');*/
        activity()
            ->on($absence_reason)
            ->by(auth()->user())
            ->withProperties(['old_name_en' => $old_object->getTranslation('name' , 'en') , 'new_name_en' => $absence_reason->getTranslation('name' , 'en')])
            ->log('Absence Reason changed');

        toastr()->success(__('messages.updated_successfully'));
        return redirect()->route('dashboard.absence_reason.index');
    }

 
    public function destroy($id)
    {
        $absence_reason = AbsenceReason::findOrFail($id);
       
        $absence_reason->delete();
        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->route('dashboard.absence_reason.index');
        
    }
}
