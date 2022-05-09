<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title' , 'score' , 'quiz_id'];

    protected $appends = ['correct_choice'];

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz');
    }

    public function choices()
    {
        return $this->hasMany('App\Models\Choice');
    }

    public function getCorrectChoiceAttribute()
    {
        return $this->choices()->where('correct' , 1)->first();
    }
}
