<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;

class EducationalStage extends Model
{
    use HasFactory, HasTranslations, LogsActivity;

    protected $table = 'educational_stages';

    protected $fillable = ['name'];

    public $translatable = ['name'];

    protected static $logAttributes = ['name'];
    protected static $logName = 'educational_stage';

    public function class_rooms()
    {
        return $this->hasMany('App\Models\ClassRoom');
    }
}
