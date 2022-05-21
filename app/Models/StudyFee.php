<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Student;
use Spatie\Activitylog\Traits\LogsActivity;

class StudyFee extends Model
{
    use HasFactory , HasTranslations , LogsActivity;

    protected $fillable = ['title' , 'description' , 'study_fee_item_id' , 'educational_stage_id' , 'class_room_id' , 'academic_year' , 'amount'];
    protected $translatable = ['title' , 'description'];

    protected static $logAttributes = ['title' , 'study_fee_item.name' , 'amount'];
    
    protected static $logName = 'study_fee';


    public function scopeSearch($query)
    {
        return $query->where(function($q){

            if(request()->filled('search'))
            {
                $q->where('title->en' , 'like' , '%' . request()->search . '%')
                    ->orWhere('title->ar' , 'like' , '%' . request()->search . '%')
                    ->orWhere('description->en' , 'like' , '%' . request()->search . '%')
                    ->orWhere('description->ar' , 'like' , '%' . request()->search . '%');
                  
            }

            if(request()->filled('educational_stage_id'))
            {
                $q->where('educational_stage_id' , request()->educational_stage_id);
            }

            if(request()->filled('class_room_id'))
            {
                $q->where('class_room_id' , request()->class_room_id);
            }

            if(request()->filled('study_fee_item_id'))
            {
                $q->where('study_fee_item_id' , request()->study_fee_item_id);
            }
        });
    }

    public function scopeFilterStudent($query , $student_id)
    {
        $student = Student::find($student_id);

        return $query->where(function($q) use($student){

            if($student)
            {
                if($student->educational_stage())
                {
                    $q->where(function($q2) use($student){
    
                        $q2->where('educational_stage_id' , $student->educational_stage()->id)
                            ->orWhereNull('educational_stage_id');
    
                    });
                }
    
                if($student->class_room)
                {
                    $q->where(function($q2) use($student){
    
                        $q2->where('class_room_id' , $student->class_room_id)
                            ->orWhereNull('class_room_id');
    
                    });
                    
                }
            }


        });
    }

    public function scopeMandatory($query)
    {
        return $query->whereHas('study_fee_item' , function($q){
            $q->where('type' , 'mandatory');
        });
    }


    public function study_fee_item()
    {
        return $this->belongsTo('App\Models\StudyFeeItem');
    }

    public function educational_stage()
    {
        return $this->belongsTo('App\Models\EducationalStage');
    }

    public function class_room()
    {
        return $this->belongsTo('App\Models\ClassRoom');
    }

}
