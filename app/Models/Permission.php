<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as Model;
use Spatie\Translatable\HasTranslations;

class Permission extends Model
{
    use HasFactory , HasTranslations;

    public $translatable = ['display_name'];
}
