<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EducationalStage extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'educational_stages';

    protected $fillable = ['name'];

    public $translatable = ['name'];

    public function class_rooms()
    {
        return $this->hasMany('App\Models\ClassRoom');
    }
}
