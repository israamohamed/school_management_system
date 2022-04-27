<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduatedStudent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
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
