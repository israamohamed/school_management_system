<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title' , 'score' , 'quiz_id'];

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz');
    }

    public function choices()
    {
        return $this->hasMany('App\Models\Choice');
    }
}
