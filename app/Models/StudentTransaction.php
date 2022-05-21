<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class StudentTransaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static $logAttributes = ['student.name' , 'type' , 'debit' , 'credit' , 'transaction_date'];
    
    protected static $logName = 'student_transaction';

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