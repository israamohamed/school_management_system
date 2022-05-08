<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OnlineClass;
use App\Http\Requests\Teachers\OnlineClassRequest;
use Illuminate\Support\Facades\DB;
use App\Services\ZoomService;

class OnlineClassController extends Controller
{
  
    public function index()
    {
        $teacher                 = auth()->guard('teacher')->user();
        $online_classes          = OnlineClass::where('teacher_id' , $teacher->id)->paginate();
        $educational_class_rooms = $teacher->educational_class_rooms;

        return view('teachers.online_classes.index' , compact('online_classes' , 'educational_class_rooms'));
    }

  
    public function create()
    {
        $teacher                  = auth()->guard('teacher')->user();
        $educational_class_rooms  = $teacher->educational_class_rooms;

        return view('teachers.online_classes.create' , compact('educational_class_rooms' ));
    }

  
    public function store(OnlineClassRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->merge([
                'teacher_id' => auth()->guard('teacher')->user()->id,
            ]);
            //1 create zoom meeting
            $zoom_service = new ZoomService();
            $zoom_meeting = $zoom_service->handle_create_online_class($request);
            //2 store meeting data in db
            $online_class = OnlineClass::create([
                'teacher_id'   => auth()->guard('teacher')->user()->id,
                'topic'        => $request->topic,
                'start_time'   => $request->start_time,
                'duration'     => $request->duration,
                'meeting_id'   => $zoom_meeting->id,
                'start_url'    => $zoom_meeting->start_url,
                'join_url'     => $zoom_meeting->join_url,
                'status'       => $zoom_meeting->status,
            ]);
            //3 Attach meeting with educational class rooms
            $online_class->educational_class_rooms()->attach($request->educational_class_rooms);
            //4 send notifications to students that teacher add a new meeting
          

            DB::commit();
            toastr()->success(__('messages.added_successfully'));
            return redirect()->route('teacher.online_class.index');
        }

        catch(\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back()->withInput()->with('error' , $e->getMessage());
        }
       
    }

   
    public function show($id)
    {
        $teacher = auth()->guard('teacher')->user();
        $online_class    = OnlineClass::with('questions')->where('id' , $id)->where('teacher_id' , $teacher->id)->firstOrFail();

        return view('teachers.online_classes.show' , compact('online_class'));
    }

   
    public function edit($id)
    {
      
    }

   
    public function update(online_classRequest $request, $id)
    {
      
    }

 
    public function destroy($id)
    {
        $teacher                  = auth()->guard('teacher')->user();
        $online_class             = OnlineClass::where('id' , $id)->where('teacher_id' , $teacher->id)->firstOrFail();

        try {
            DB::beginTransaction();      
            //Delete Zoom Meeting
            $zoom_service = new ZoomService();
            $zoom_service->delete_meeting($online_class->meeting_id);

            $online_class->educational_class_rooms()->detach();
            $online_class->delete();
            DB::commit();
            toastr()->success(__('messages.deleted_successfully'));
            return redirect()->back();
        }

        catch(\Exception $e) {
            DB::rollBack();
            $online_class->educational_class_rooms()->detach();
            $online_class->delete();

            toastr()->error($e->getMessage());
            return back()->withInput()->with('error' , $e->getMessage());
        }
    }
}
