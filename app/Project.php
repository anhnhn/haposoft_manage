<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'start_date', 'end_date', 'customer_id'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public  function  logs()
    {
        return $this->hasMany('App\Log');
    }
}
