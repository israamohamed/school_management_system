<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class GraduatedStudent extends Model
{
    use HasFactory , LogsActivity;

    protected $guarded = ['id'];

    protected static $logAttributes = ['student.name' , 'previous_academic_year' , 'previous_class_room.name' , 'previous_educational_stage.name'];
    protected static $logName = 'graduated_student';


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
}
