<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'name', 'content', 'user_id'
    ];

    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
