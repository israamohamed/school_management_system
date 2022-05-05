<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\Attachments\HasAttachments;

class Teacher extends Model
{
    use HasFactory , HasTranslations , HasAttachments;

    protected $fillable = ['name' , 'email' , 'password' , 'gender' , 'hiring_date' , 'birth_date' , 'phone_number1' , 'phone_number2' , 'active'];

    protected $translatable = ['name'];

    protected $appends = ['profile_picture'];

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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}
