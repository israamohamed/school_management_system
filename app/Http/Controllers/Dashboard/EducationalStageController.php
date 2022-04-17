<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationalStage;
use App\Http\Requests\StoreEducationalStageRequest;
use App\Http\Requests\UpdateEducationalStageRequest;

class EducationalStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educational_stages = EducationalStage::paginate(10);
        return view('dashboard.educational_stages.index' , compact('educational_stages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEducationalStageRequest $request)
    {
        $request->validated();

        $request->merge([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ]
        ]);

        $educational_stage = EducationalStage::create($request->all());
        toastr()->success(__('messages.added_successfully'));
        return redirect()->route('dashboard.educational_stage.index');
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
    public function update(UpdateEducationalStageRequest $request, $id)
    {
        $request->validated();

        $request->merge([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ]
        ]);

        $educational_stage = EducationalStage::findOrFail($id);

        $educational_stage->update($request->all());
        toastr()->success(__('messages.updated_successfully'));
        return redirect()->route('dashboard.educational_stage.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $educational_stage = EducationalStage::findOrFail($id);
        //check if educational stage has class rooms
        if($educational_stage->class_rooms()->count() > 0)
        {
            toastr()->error(__('messages.educational_stage_has_class_rooms_warning'));
            return redirect()->route('dashboard.educational_stage.index');
        }
        else 
        {
            $educational_stage->delete();
            toastr()->success(__('messages.deleted_successfully'));
            return redirect()->route('dashboard.educational_stage.index');
        }


      
    }
}
