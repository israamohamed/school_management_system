<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeSearch($query)
    {
        if(request()->filled('attendance_date'))
        {
            $query->whereDate('attendance_date' , request()->attendance_date );
        }

        if(request()->filled('academic_year'))
        {
            $query->where('academic_year' , request()->academic_year );
        }

        if(request()->filled('class_room_id'))
        {
            $query->where('class_room_id' , request()->class_room_id );
        }

        if(request()->filled('educational_class_room_id'))
        {
            $query->where('educational_class_room_id' , request()->educational_class_room_id );
        }

        if(request()->filled('student_id'))
        {
            $query->where('student_id' , request()->student_id );
        }

        if(request()->filled('absence_reason_id'))
        {
            $query->where('absence_reason_id' , request()->absence_reason_id );
        }
    }
    public function class_room()
    {
        return $this->belongsTo('App\Models\ClassRoom');
    }

    public function educational_class_room()
    {
        return $this->belongsTo('App\Models\EducationalClassRoom');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function absence_reason()
    {
        return $this->belongsTo('App\Models\AbsenceReason');
    }
}
