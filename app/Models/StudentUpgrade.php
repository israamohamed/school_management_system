<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class StudentUpgrade extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = ['id'];

    protected static $logAttributes = ['student.name' , 'previous_class_room.name' , 'previous_educational_class_room.name' , 'previous_academic_year' , 'next_class_room.name' , 'next_educational_class_room.name' , 'next_academic_year'];
    
    protected static $logName = 'student_upgrade';

    public function student()
    {
        return $this->belongsTo('App\Models\Student')->withoutGlobalScope('enrolled_students');
    }

    public function previous_educational_stage()
    {
        return $this->previous_class_room ? $this->previous_class_room->educational_stage : null;
    }

    public function previous_class_room()
    {
        return $this->belongsTo('App\Models\ClassRoom' , 'previous_class_room_id');
    }

    public function previous_educational_class_room()
    {
        return $this->belongsTo('App\Models\EducationalClassRoom' , 'previous_educational_class_room_id');
    }

    public function next_educational_stage()
    {
        return $this->next_class_room ? $this->next_class_room->educational_stage : null;
    }

    public function next_class_room()
    {
        return $this->belongsTo('App\Models\ClassRoom' , 'next_class_room_id');
    }

    public function next_educational_class_room()
    {
        return $this->belongsTo('App\Models\EducationalClassRoom' , 'next_educational_class_room_id');
    }

   

}
