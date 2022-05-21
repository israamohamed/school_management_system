<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class OnlineClass extends Model
{
    use HasFactory , LogsActivity;

    protected $fillable = ['topic' , 'start_time' , 'duration' , 'password' , 'teacher_id' , 'meeting_id' ,'start_url' , 'join_url' , 'status'];

    protected static $logAttributes = ['topic' , 'start_time' , 'teacher.name'];
    protected static $logName = 'online_class';

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function educational_class_rooms()
    {
        return $this->belongsToMany('App\Models\EducationalClassRoom');
    }
}
