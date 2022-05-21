<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Attachments\HasAttachments;
use Spatie\Activitylog\Traits\LogsActivity;

class FinancialBond extends Model
{
    use HasFactory , HasAttachments , LogsActivity;

    protected $guarded = ['id'];

    protected static $logAttributes = ['student.name' , 'date' , 'type' , 'amount' , 'notes'];
    protected static $logName = 'financial_bond';

    public function scopeSearh($query)
    {
        $query->whereHas(function($q){

            if(request()->filled('student_id'))
            {
                $q->where('student_id' , request()->student_id);
            }

            if(request()->filled('type')) //catch || expense
            {
                $q->where('type' , request()->type);
            }

            if(request()->filled('date'))
            {
                $q->whereDate('date' , request()->date);
            }
        });
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function student_transaction()
    {
        return $this->hasOne('App\Models\StudentTransaction');
    }

    public function school_fund()
    {
        return $this->hasOne('App\Models\SchoolFund');
    }
}
