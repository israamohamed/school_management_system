<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Attachments\HasAttachments;
use Spatie\Activitylog\Traits\LogsActivity;

class StudentInvoice extends Model
{
    use HasFactory , HasAttachments , LogsActivity;

    protected $guarded = ['id' , 'status'];

    protected static $logAttributes = ['student.name' , 'study_fee.title' , 'invoice_date' , 'total' , 'discount' , 'final_total'];
    
    protected static $logName = 'student_invoice';

    public function scopeSearch($query)
    {
        $query->where(function($q){

            if(request()->filled('student_id'))
            {
                $q->where('student_id' , request()->student_id);
            }

            if(request()->filled('study_fee_id'))
            {
                $q->where('study_fee_id' , request()->study_fee_id);
            }

            if(request()->filled('study_fee_item_id'))
            {
                $q->whereHas('study_fee' , function($q2){

                    $q2->where('study_fees.study_fee_item_id' , request()->study_fee_item_id);

                });
                
            }

            if(request()->filled('invoice_date'))
            {
                $q->whereDate('invoice_date' , request()->invoice_date);
            }

            if(request()->filled('from') || request()->filled('to')   )
            {
                $from = date("Y-m-d" , strtotime( request()->from ) );
                $to = date("Y-m-d" , strtotime(request()->to) );
                $q->whereBetween('invoice_date' ,   [ $from , $to] );
            }
        });
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student')->withoutGlobalScope('enrolled_students');
    }

    public function study_fee()
    {
        return $this->belongsTo('App\Models\StudyFee');
    }

    public function student_transactions()
    {
        return $this->hasMany('App\Models\StudentTransaction');
    }
}
