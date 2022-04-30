<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Attachments\HasAttachments;

class FinancialBond extends Model
{
    use HasFactory , HasAttachments;

    protected $guarded = ['id'];

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
}