<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Attachments\HasAttachments;

class StudentInvoice extends Model
{
    use HasFactory , HasAttachments;

    protected $guarded = ['id' , 'status'];

    public function scopeSearh($query)
    {
        $query->whereHas(function($q){

            if(request()->filled('student_id'))
            {
                $q->where('student_id' , request()->student_id);
            }

            if(request()->filled('study_fee_id'))
            {
                $q->where('study_fee_id' , request()->study_fee_id);
            }

            if(request()->filled('invoice_date'))
            {
                $q->whereDate('invoice_date' , request()->invoice_date);
            }
        });
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
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
