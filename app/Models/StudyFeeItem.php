<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;

class StudyFeeItem extends Model
{
    use HasFactory , HasTranslations , LogsActivity;

    protected $fillable = ['name' , 'type'];
    protected $translatable = ['name'];

    protected static $logAttributes = ['name'];
    
    protected static $logName = 'study_fee_item';

    public function study_fees()
    {
        return $this->hasMany('App\Models\StudyFee');
    }
}
