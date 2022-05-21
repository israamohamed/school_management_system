<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;

class AbsenceReason extends Model
{
    use HasFactory , HasTranslations , LogsActivity;

    protected $fillable = ['name'];
    protected $translatable = ['name'];

    protected static $logAttributes = ['name'];
    protected static $logName = 'absence_reason';
}
