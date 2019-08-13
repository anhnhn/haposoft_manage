<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'birth_day', 'address', 'phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }

    public function logs()
    {
        return $this->hasMany('App\Log');
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }
}
