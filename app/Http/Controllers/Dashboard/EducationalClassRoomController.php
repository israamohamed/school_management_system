<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationalClassRoom;
use App\Http\Requests\StoreEducationalClassRoomRequest;
use App\Http\Requests\UpdateEducationalClassRoomRequest;
use App\Models\EducationalStage;

class EducationalClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educational_class_rooms = EducationalClassRoom::paginate(10);
        $educational_stages = EducationalStage::get();
        return view('dashboard.educational_class_rooms.index' , compact('educational_class_rooms' , 'educational_stages'));
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
    public function store(StoreEducationalClassRoomRequest $request)
    {
        $request->merge([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'active' => $request->active ? true : false
        ]);

        $educational_class_room = EducationalClassRoom::create($request->all());
        toastr()->success(__('messages.added_successfully'));
        return redirect()->route('dashboard.educational_class_room.index');
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
    public function update(UpdateEducationalClassRoomRequest $request, $id)
    {
        $request->validated();

        $request->merge([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'active' => $request->active ? true : false
        ]);

        $educational_class_room = EducationalClassRoom::findOrFail($id);

        $educational_class_room->update($request->all());
        toastr()->success(__('messages.updated_successfully'));
        return redirect()->route('dashboard.educational_class_room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $educational_class_room = EducationalClassRoom::findOrFail($id);
        
        $educational_class_room->delete();
        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->route('dashboard.educational_class_room.index');
        
    }
}
