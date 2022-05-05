<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory , HasTranslations;

    protected $fillable = ['name' , 'class_room_id' , 'upper_grade' , 'lower_grade' , 'main_subject' , 'success_required' , 'shared_between_terms' , 'term' , 'active'];

    protected $translatable = ['name'];

    public function scopeSearch($query)
    {
        return $query->where(function($q){
            if(request()->filled('search'))
            {
                $q->where('name->en' , 'like' , '%' . request()->search . '%')
                    ->orWhere('name->ar' , 'like' , '%' . request()->search . '%');
            }

            if(request()->filled('class_room_id'))
            {
                $q->where('class_room_id' , request()->class_room_id);
            }

        });
    }

    public function class_room()
    {
        return $this->belongsTo('App\Models\ClassRoom');
    }
    
    public function educational_stage()
    {
        return $this->class_room ? $this->class_room->educational_stage : null;
    }
}
