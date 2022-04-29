<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolFund extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function financial_bond()
    {
        return $this->belongsTo('App\Models\FinancialBond');
    }

}
