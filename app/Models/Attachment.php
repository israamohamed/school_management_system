<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['attachmentable_type' , 'attachmentable_id' , 'path' , 'type'];

    public function attachmentable()
    {
        return $this->morphTo();
    }
}
