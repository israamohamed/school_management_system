<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Attachments\HasAttachments;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;

class SchoolData extends Model
{
    use HasFactory , HasAttachments , HasTranslations , LogsActivity;

    protected $fillable = ['name' , 'email' , 'address' , 'phone_number1' , 'phone_number2'];

    protected $appends = ['logo'];

    public $translatable = ['name' , 'address'];

    protected static $logAttributes = ['name' , 'email' , 'address' , 'phone_number1' , 'phone_number2'];
    protected static $logName = 'school_data';

}
