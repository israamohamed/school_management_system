<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles , LogsActivity;

    //The attributes that need to be logged
    protected static $logAttributes = ['name' , 'email'];

    //If you want to log changes to all the $fillable attributes : 
    //protected static $logFillable = true;   //you can use wildcar also ['*']

    //If you have a lot of attributes and use $guarded instead of $fillable
    //protected static $logUnguarded = true;

    //Customizing the events being logged
    //only the `deleted` event will get logged automatically
    //protected static $recordEvents = ['deleted'];

    //Customizing the log name
    protected static $logName = 'user';

    //Ignoring changes to certain attributes
    //Changing password will not trigger an activity being logged.
    protected static $ignoreChangedAttributes = ['password' , 'updated_at'];

    //Logging only the changed attributes
    //protected static $logOnlyDirty = true;

    //prevents the package from storing empty logs.
    //protected static $submitEmptyLogs = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   


    public function scopeSearch($query)
    {
        return $query->where(function($q){
            if(request()->filled('search'))
            {
                $q->where('name' , 'like' , '%' . request()->search . '%')
                    ->orWhere('email' , 'like' , '%' . request()->search . '%'  );
            }

            if(request()->filled('role_id'))
            {
                $q->whereHas('roles' , function($q2){
                    $q2->where('roles.id' , request()->role_id);
                });
            }
        });
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


}
