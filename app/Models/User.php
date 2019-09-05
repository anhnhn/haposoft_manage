<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Config;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'birth_day', 'address', 'phone', 'avatar', 'department_id', 'role_name'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('start_date', 'end_date')->withTimestamps();
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getUrlAttribute($value)
    {
        return url('/').Config('variables.url').$value;
    }
}
