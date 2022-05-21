<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Attachment extends Model
{
    use HasFactory , LogsActivity;

    protected $fillable = ['attachmentable_type' , 'attachmentable_id' , 'path' , 'type' , 'description' , 'teacher_id'];
    protected $appends = ['url'];

    protected static $logAttributes = ['description'];
    protected static $logName = 'attachment';

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
