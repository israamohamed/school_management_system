<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OnlineClass;

class OnlineClassController extends Controller
{
    public function index()
    {
        $student = auth()->guard('student')->user();

        $upcoming_online_classes = OnlineClass::whereHas('educational_class_rooms' , function($query) use($student) {

            $query->where('educational_class_rooms.id' , $student->educational_class_room_id)
                ->where('start_time' , '>' , date("Y-m-d H:i"));

        })->paginate();

        $previous_online_classes = OnlineClass::whereHas('educational_class_rooms' , function($query) use($student) {

            $query->where('educational_class_rooms.id' , $student->educational_class_room_id)
                    ->where('start_time' , '<=' , date("Y-m-d H:i"));

        })->paginate();

        return view('students.online_classes.index' , compact('upcoming_online_classes' , 'previous_online_classes'));
    }
}
