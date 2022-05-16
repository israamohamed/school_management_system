<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as Model;
use Spatie\Translatable\HasTranslations;

class Role extends Model
{
    use HasFactory , HasTranslations;

    public $translatable = ['display_name'];

}
