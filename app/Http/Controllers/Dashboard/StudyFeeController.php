<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EducationalStage;
use App\Models\ClassRoom;
use App\Http\Requests\StudyFeeRequest;
use App\Models\StudyFeeItem;
use App\Models\StudyFee;

class StudyFeeController extends Controller
{
  
    public function index()
    {
        $study_fees = StudyFee::search()->paginate(20);
        $educational_stages = EducationalStage::get();
        $class_rooms = ClassRoom::where('educational_stage_id' , request()->educational_stage_id)->get();
        $study_fee_items = StudyFeeItem::get();

        return view('dashboard.study_fees.index' , compact('study_fees' , 'study_fee_items' , 'educational_stages' ,'class_rooms'));
    }

   
    public function create()
    {
        $educational_stages = EducationalStage::get();
        $study_fee_items = StudyFeeItem::get();

        return view('dashboard.study_fees.create' , compact('educational_stages' , 'study_fee_items') );
    }

   
    public function store(StudyFeeRequest $request)
    {
        $request->merge([
            'title' =>   [
                'en' => $request->title_en, 'ar' => $request->title_ar 
            ],

            'description' =>   [
                'en' => $request->description_en, 'ar' => $request->description_ar 
            ],

        ]);

        try {
            //store study_fee in db
            $exists = StudyFee::where('study_fee_item_id' , $request->study_fee_item_id)
                                ->where('educational_stage_id' , $request->educational_stage_id)
                                ->where('class_room_id' , $request->class_room_id)
                                ->where('academic_year' , $request->academic_year)
                                ->exists();
            if($exists)
            {
                toastr()->error(__('messages.study_fees_exists_before'));
                return back()->with('error' , __('messages.study_fees_exists_before'));
            }
            $study_fee = StudyFee::create($request->all());          
            //success message
            toastr()->success(__('messages.added_successfully'));
            return redirect()->route('dashboard.study_fee.index');
            
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
        $study_fee = StudyFee::findOrFail($id);
        return view('dashboard.study_fees.show' , compact('study_fee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $study_fee = StudyFee::findOrFail($id);

        $educational_stages = EducationalStage::get();
        $study_fee_items = StudyFeeItem::get();

        return view('dashboard.study_fees.edit' , compact('study_fee' , 'educational_stages' , 'study_fee_items') );
    }

  
    public function update(StudyFeeRequest $request, $id)
    {
        $study_fee = StudyFee::findOrFail($id);

        $request->merge([
            'title' =>   [
                'en' => $request->title_en, 'ar' => $request->title_ar 
            ],

            'description' =>   [
                'en' => $request->description_en, 'ar' => $request->description_ar 
            ],
        ]);

        try {
            $exists = StudyFee::where('study_fee_item_id' , $request->study_fee_item_id)
                                ->where('educational_stage_id' , $request->educational_stage_id)
                                ->where('class_room_id' , $request->class_room_id)
                                ->where('academic_year' , $request->academic_year)
                                ->where('id' , '!=' , $study_fee->id)
                                ->exists();

            if($exists)
            {
                toastr()->error(__('messages.study_fees_exists_before'));
                return back()->with('error' , __('messages.study_fees_exists_before'));
            }


            //update study_fee in db
            $study_fee->update($request->all());
            

            toastr()->success(__('messages.updated_successfully'));
            return redirect()->route('dashboard.study_fee.index');
            
        }
     
        catch(\Exception $e) {
            toastr()->error($e->getMessage());
            return back()->with('error' , $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $study_fee = StudyFee::findOrFail($id);
        
        $study_fee->delete();
        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->route('dashboard.study_fee.index');
    }
}
