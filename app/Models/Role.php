<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use HasFactory , HasTranslations , LogsActivity;

    public $translatable = ['display_name'];

    protected static $logAttributes = ['name' , 'display_name'];
    protected static $logName = 'role';

}
