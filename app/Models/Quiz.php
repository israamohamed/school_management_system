<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'teacher_id' , 'educational_class_room_id' , 'subject_id' , 'time_in_minutes' , 'active' , 'status'];

    protected $appends = ['status_color' , 'score'];

    public function scopeActive($query)
    {
        return $query->where('active' , 1);
    }

    public function scopeSearch($query)
    {
        return $query->where(function($q){

            if(request()->filled('search'))
            {
                $q->where('name' , 'like' , '%' . request()->search . '%');
            }

            if(request()->filled('subject_id'))
            {
                $q->where('subject_id' , request()->subject_id);              
            }

            if(request()->filled('status'))
            {
                $q->where('status' , request()->status);              
            }

        });
    }

    public function teacher() {

        return $this->belongsTo('App\Models\Teacher');
    }

    public function educational_class_room() {
        
        return $this->belongsTo('App\Models\EducationalClassRoom');
    }

    public function subject() {
        
        return $this->belongsTo('App\Models\Subject');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function students()
    {
        return $this->belongsToMany('App\Models\Student')->withPivot('score' , 'joined' , 'started');
    }
    

    public function getStatusColorAttribute()
    {
        if($this->status == 'pending')
        {
            return 'info';
        }

        else if($this->status == 'started')
        {
            return 'warning';
        }

        else if($this->status == 'finished')
        {
            return 'danger';
        }
        else 
        {
            return 'secondary';
        }
    }

    public function getScoreAttribute()
    {
        return $this->questions()->sum('score');
    }
}
