<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['attachmentable_type' , 'attachmentable_id' , 'path' , 'type' , 'description' , 'teacher_id'];
    protected $appends = ['url'];

    public function attachmentable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return asset('uploads/' . $this->path);
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }
}
