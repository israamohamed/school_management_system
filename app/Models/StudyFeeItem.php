<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class StudyFeeItem extends Model
{
    use HasFactory , HasTranslations;

    protected $fillable = ['name' , 'type'];
    protected $translatable = ['name'];

    public function study_fees()
    {
        return $this->hasMany('App\Models\StudyFee');
    }
}
