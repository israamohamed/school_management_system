<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\Attachments\HasAttachments;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class Teacher extends Authenticatable
{
    use HasFactory , HasTranslations , HasAttachments , LogsActivity;

    protected $fillable = ['name' , 'email' , 'password' , 'gender' , 'hiring_date' , 'birth_date' , 'phone_number1' , 'phone_number2' , 'active'];

    protected $translatable = ['name'];

    protected $appends = ['profile_picture'];

    protected static $logAttributes = ['name' , 'email' , 'phone_number1'];
    
    protected static $logName = 'teacher';

    public function scopeSearch($query)
    {
        return $query->where(function($q){

            if(request()->filled('search'))
            {
                $q->where('name->en' , 'like' , '%' . request()->search . '%')
                    ->orWhere('name->ar' , 'like' , '%' . request()->search . '%')
                    ->orWhere('email' , 'like' , '%' . request()->search . '%');
            }

            if(request()->filled('subject_id'))
            {
                $q->whereHas('subjects' , function($q2){

                    $q2->where('subjects.id' , request()->subject_id);
                });
            }
        });
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Models\Subject');
    }

    public function educational_class_rooms()
    {
        return $this->belongsToMany('App\Models\EducationalClassRoom');
    }

    public function quizzes()
    {
        return $this->hasMany('App\Models\Quiz');
    }

    public function subject_attachments()
    {
        return $this->hasMany('App\Models\Attachment');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}
