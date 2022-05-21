<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SchoolFund extends Model
{
    use HasFactory , LogsActivity;

    protected $guarded = ['id'];

    protected static $logAttributes = ['date' , 'debit' , 'credit'];
    
    protected static $logName = 'school_fund';

    public function financial_bond()
    {
        return $this->belongsTo('App\Models\FinancialBond');
    }

}
