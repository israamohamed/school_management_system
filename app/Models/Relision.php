<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Relision extends Model
{
    use HasFactory , HasTranslations;

    protected $table = 'relisions';
    protected $fillable = ['name' , 'active'];
}
