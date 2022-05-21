<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class EducationalClassRoom extends Model
{
    use HasFactory , HasTranslations , LogsActivity;

    protected $table = 'educational_class_rooms';

    protected $fillable = ['name' , 'number_of_students' , 'active' , 'class_room_id'];

    protected $translatable = ['name'];

    protected static $logAttributes = ['name' , 'number_of_students' , 'class_room.name'];
    protected static $logName = 'educational_class_room';

    protected static function booted()
    {
        static::addGlobalScope('teachers_educational_class_rooms', function (Builder $builder) {

            if(auth()->guard('teacher')->check())
            {
                $builder->whereHas('teachers' ,function($query){
                    $query->where('teachers.id', auth()->guard('teacher')->user()->id );

                });
            }
           
        });
    }

    public function scopeSearch($query)
    {
        return $query->where(function($q){

            if(request()->filled('class_room_id'))
            {
                $q->where('class_room_id' , request()->class_room_id);
            }

            
        });
    }

    public function class_room()
    {
        return $this->belongsTo('App\Models\ClassRoom');
    }

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\StudentAttendance');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher');
    }

    public function online_classes()
    {
        return $this->belongsToMany('App\Models\OnlineClass');
    }
}
