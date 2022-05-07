<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineClass extends Model
{
    use HasFactory;

    protected $fillable = ['topic' , 'start_time' , 'duration' , 'password' , 'teacher_id' , 'meeting_id' ,'start_url' , 'join_url' , 'status'];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function educational_class_rooms()
    {
        return $this->belongsToMany('App\Models\EducationalClassRoom');
    }
}
