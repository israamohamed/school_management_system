<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SystemSetting extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['create_student_invoices_automatically'];

    protected static $logName = 'system_setting';
}
