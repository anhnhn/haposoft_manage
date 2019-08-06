<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'email', 'address', 'phone', 'password'
    ];

    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    public function logs()
    {
        return $this->hasMany('App\Log');
    }
}

