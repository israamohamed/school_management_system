<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\Attachments\HasAttachments;

class StudentParent extends Model
{
    use HasFactory , HasTranslations , HasAttachments;

    protected $fillable = ['email' , 'password' , 'father_name' , 'father_national_id' , 
                            'father_passport_number' , 'father_phone_number' , 'father_job' , 
                            'father_blood_type_id' , 'father_nationality_id' , 'father_relision_id' ,
                            'father_address', 'mother_name' , 'mother_national_id' , 
                            'mother_passport_number' , 'mother_phone_number' , 'mother_job' , 
                            'mother_blood_type_id' , 'mother_nationality_id' , 'mother_relision_id' ,
                            'mother_address'];

    public $translatable = ['father_name' , 'mother_name'];

    public function father_blood_type()
    {
        return $this->belongsTo('App\Models\BloodType' , 'father_blood_type_id');
    }

    public function father_nationality()
    {
        return $this->belongsTo('App\Models\Nationality' , 'father_nationality_id');
    }

    public function father_relision()
    {
        return $this->belongsTo('App\Models\Relision' , 'father_relision_id');
    }

    public function mother_blood_type()
    {
        return $this->belongsTo('App\Models\BloodType' , 'mother_blood_type_id');
    }

    public function mother_nationality()
    {
        return $this->belongsTo('App\Models\Nationality' , 'mother_nationality_id');
    }

    public function mother_relision()
    {
        return $this->belongsTo('App\Models\Relision' , 'mother_relision_id');
    }

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
