<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use App\Models\Teacher;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activity_logs = Activity::search()->latest()->paginate(20);
        $subjects      = Activity::subjects_list();
        $users         = User::select('id' , 'name')->get();
        $teachers      = Teacher::select('id' , 'name')->get();
        return view('dashboard.activity_logs.index' , compact('activity_logs' , 'subjects' , 'users' , 'teachers'));
    }
}
