<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoom;
use App\Http\Requests\StoreClassRoomRequest;
use App\Http\Requests\UpdateClassRoomRequest;
use App\Models\EducationalStage;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_rooms = ClassRoom::where(function($query){
            if(request()->filled('educational_stage_id'))
            {
                $query->where('educational_stage_id' , request()->educational_stage_id);
            }
        })->paginate(10);
        $educational_stages = EducationalStage::get();
        return view('dashboard.class_rooms.index' , compact('class_rooms' , 'educational_stages'));
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
    public function store(StoreClassRoomRequest $request)
    {
        try {
            $counter = 0;

            foreach($request->class_rooms as $class_room)
            {
                ClassRoom::create([
                    'name'                 => ['en' => $class_room['name_en'] , 'ar' => $class_room['name_ar'] ],
                    'educational_stage_id' => $class_room['educational_stage_id'],
                    'last_class_room'      => array_key_exists('last_class_room' , $class_room) ? true : false,
                ]);
                $counter++;
            }
          
            if($counter > 1) {
                toastr()->success(__('messages.more_that_record_added' , ['number' => $counter]));
            }
            else {
                toastr()->success(__('messages.added_successfully'));
            }
            
            return redirect()->route('dashboard.class_room.index');
        }

        catch(\Exception $e) {
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
    public function update(UpdateClassRoomRequest $request, $id)
    {
        $request->validated();

        $request->merge([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ]
        ]);

        $class_room = ClassRoom::findOrFail($id);

        $class_room->update($request->all());
        toastr()->success(__('messages.updated_successfully'));
        return redirect()->route('dashboard.class_room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eucational_stage = ClassRoom::findOrFail($id);
        $eucational_stage->delete();
        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->route('dashboard.class_room.index');
    }

    public function delete_selected(Request $request)
    {
        $selected_rows = $request->selected_rows;
        if($selected_rows)
        {
            $selected_rows_ids = explode("," , $selected_rows);
            $class_rooms = ClassRoom::whereIn('id' , $selected_rows_ids)->delete();
            toastr()->success(__('messages.deleted_successfully'));
            return redirect()->route('dashboard.class_room.index');
        }
        else 
        {
            toastr()->error(__('messages.error_occured'));
            return redirect()->route('dashboard.class_room.index');
        }
        
    }
}
