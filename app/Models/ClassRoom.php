<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;

class ClassRoom extends Model
{
    use HasFactory, HasTranslations , LogsActivity;

    protected $table = 'class_rooms';

    protected $fillable = ['name' , 'educational_stage_id' , 'last_class_room'];

    public $translatable = ['name'];

    protected static $logAttributes = ['name' , 'educational_stage.name'];
    protected static $logName = 'class_room';

    public function educational_stage()
    {
        return $this->belongsTo('App\Models\EducationalStage');
    }

    public function educational_class_rooms()
    {
        return $this->hasMany('App\Models\EducationalClassRoom');
    }

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }
}
