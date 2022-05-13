<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\Attachments\HasAttachments;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;

class Student extends Authenticatable
{
    use HasFactory , HasTranslations, HasAttachments;

    protected $guarded = ['id'];
    public $translatable = ['name' , 'birth_place'];
    protected $appends = ['profile_picture' , 'balance' , 'date'];


    protected static function booted()
    {
        static::addGlobalScope('enrolled_students', function (Builder $builder) {

            $builder->where('status' , 'enrolled');
           
        });
    }

    public function scopeSearch($query)
    {
        return $query->where(function($q){
            if(request()->filled('search'))
            {
                $q->where('name->en' , 'like' , '%' . request()->search . '%')
                    ->orWhere('name->ar' , 'like' , '%' . request()->search . '%')
                    ->orWhere('email' , 'like' , '%' . request()->search . '%')
                    ->orWhere('code' , 'like' , '%' . request()->search . '%')
                    ->orWhere('phone_number1' , 'like' , '%' . request()->search . '%')
                    ->orWhere('phone_number2' , 'like' , '%' . request()->search . '%')
                    ->orWhere('notes' , 'like' , '%' . request()->search . '%') ;
            }

            if(request()->filled('educational_stage_id'))
            {
                $q->whereHas('class_room' , function($q2){
                    $q2->where('educational_stage_id' , request()->educational_stage_id);
                });
            }

            if(request()->filled('class_room_id'))
            {
                $q->where('class_room_id' , request()->class_room_id);
            }

            if(request()->filled('educational_class_room_id'))
            {
                $q->where('educational_class_room_id' , request()->educational_class_room_id);
            }
        });
    }

    public function scopeEnrolled($query)
    {
        return $query->where('status' , 'enrolled');
    }

    public function scopeGarduated($query)
    {
        return $query->where('status' , 'graduated');
    }

    public function blood_type()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function nationality()
    {
        return $this->belongsTo('App\Models\Nationality');
    }

    public function relision()
    {
        return $this->belongsTo('App\Models\Relision');
    }

    public function student_parent()
    {
        return $this->belongsTo('App\Models\StudentParent');
    }

    public function educational_stage()
    {
        return $this->class_room ? $this->class_room->educational_stage : null;
    }

    public function class_room()
    {
        return $this->belongsTo('App\Models\ClassRoom');
    }

    public function educational_class_room()
    {
        return $this->belongsTo('App\Models\EducationalClassRoom');
    }

    public function created_by()
    {
        return $this->belongsTo('App\Models\User' , 'user_id');
    }

    public function student_upgrades()
    {
        return $this->hasMany('App\Models\StudentUpgrade');
    }

    public function graduated_students()
    {
        return $this->hasMany('App\Models\GraduatedStudent');
    }

    public function student_invoices()
    {
        return $this->hasMany('App\Models\StudentInvoice');
    }

    public function financial_bonds()
    {
        return $this->hasMany('App\Models\FinancialBond');
    }

    public function student_transactions()
    {
        return $this->hasMany('App\Models\StudentTransaction');
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\StudentAttendance');
    }

    public function quizzes()
    {
        return $this->belongsToMany('App\Models\Quiz')->withPivot('score' , 'joined' , 'started');
    }

    public function questions()
    {
        return $this->belongsToMany('App\Models\Question')->withPivot('quiz_id' , 'choice_id' , 'correct' , 'score' , 'answer');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getBalanceAttribute()
    {
        return $this->student_transactions()->sum('debit') - $this->student_transactions()->sum('credit');
    }

    public function getDateAttribute()
    {
        return date("Y-m-d" , strtotime( $this->created_at));
    }

}
