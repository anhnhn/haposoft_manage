<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    protected $guard = 'customer';

    protected $fillable = [
        'name', 'email', 'address', 'phone', 'role_name'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
