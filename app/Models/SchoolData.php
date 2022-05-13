<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Attachments\HasAttachments;
use Spatie\Translatable\HasTranslations;

class SchoolData extends Model
{
    use HasFactory , HasAttachments , HasTranslations;

    protected $fillable = ['name' , 'email' , 'address' , 'phone_number1' , 'phone_number2'];

    protected $appends = ['logo'];

    public $translatable = ['name' , 'address'];

}
