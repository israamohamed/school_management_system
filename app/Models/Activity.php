<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Models\Activity as Model;

class Activity extends Model
{
    use HasFactory;

    public function getDescriptionAttribute($value)
    {
        $description = $value;

        if($value == 'created')
        {
            $description = __('activity_logs.create_log' , ['subject' => __('activity_logs.' . $this->log_name)   ]);
        }

        else if($value == 'updated')
        {
            $description = __('activity_logs.update_log' , ['subject' => __('activity_logs.' . $this->log_name)   ]);
        }

        else if($value == 'deleted')
        {
            $description = __('activity_logs.delete_log' , ['subject' => __('activity_logs.' . $this->log_name)   ]);
        }

        return $description;
    }

    public function scopeSearch($query)
    {
        return $query->where(function($q){

            if( request()->filled('created_at'))
            {
                $q->whereDate('created_at' , request()->created_at );
            }

            if( request()->filled('user_id'))
            {
                $q->where('causer_id' , request()->user_id )->where('causer_type' , 'App\Models\User' );
            }

            if( request()->filled('teacher_id'))
            {
                $q->where('causer_id' , request()->teacher_id )->where('causer_type' , 'App\Models\Teacher' );
            }

            if( request()->filled('log_name'))
            {
                $q->where('log_name' , request()->log_name );
            }
        });
    }

    public static function subjects_list()
    {
        return [
            'absence_reason'    => __('activity_logs.absence_reason'),
            'attachment'        => __('activity_logs.attachment'),
            'blood_type'        => __('activity_logs.blood_type'),
            'choice'            => __('activity_logs.choice'),
            'class_room'        => __('activity_logs.class_room'),
            'educational_class_room' => __('activity_logs.educational_class_room'),
            'educational_stage'      => __('activity_logs.educational_stage'),
            'event'                  => __('activity_logs.event'),
            'financial_bond'         => __('activity_logs.financial_bond'),
            'graduated_student'      => __('activity_logs.graduated_student'),
            'nationality'            => __('activity_logs.nationality'),
            'online_class'           => __('activity_logs.online_class'),
            'question'               => __('activity_logs.question'),
            'quiz'                   => __('activity_logs.quiz'),
            'relision'               => __('activity_logs.relision'),
            'role'                   => __('activity_logs.role'),
            'school_data'            => __('activity_logs.school_data'), 
            'school_fund'            => __('activity_logs.school_fund'),
            'student'                => __('activity_logs.student'),
            'student_attendance'     => __('activity_logs.student_attendance'),
            'student_invoice'        => __('activity_logs.student_invoice'),
            'student_parent'         => __('activity_logs.student_parent'),
            'student_transaction'    => __('activity_logs.student_transaction'),
            'student_upgrade'        => __('activity_logs.student_upgrade'),
            'study_fee'              => __('activity_logs.study_fee'),
            'study_fee_item'         => __('activity_logs.study_fee_item'),
            'subject'                => __('activity_logs.subject'),
            'system_setting'         => __('activity_logs.system_setting'),
            'teacher'                => __('activity_logs.teacher'),
            'user'                   => __('activity_logs.user'),
        ];
    }

    public function getCreatedAtAttribute($value)
    {
        if($value)
        {
            return \Carbon\Carbon::parse($value)
                        ->format('Y-m-d h:i a');
        }
        else
        {
            return '';
        }
    }
}
