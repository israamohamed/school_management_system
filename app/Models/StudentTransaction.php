<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTransaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function student_invoice()
    {
        return $this->belongsTo('App\Models\StudentInvoice');
    }

    public function financial_bond()
    {
        return $this->belongsTo('App\Models\FinancialBond');
    }
}