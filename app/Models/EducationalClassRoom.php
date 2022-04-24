<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EducationalClassRoom extends Model
{
    use HasFactory , HasTranslations;

    protected $table = 'educational_class_rooms';

    protected $fillable = ['name' , 'number_of_students' , 'active' , 'class_room_id'];

    protected $translatable = ['name'];

    public function class_room()
    {
        return $this->belongsTo('App\Models\ClassRoom');
    }

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }
}
