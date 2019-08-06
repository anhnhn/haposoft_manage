<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'type', 'object', 'description', 'user_id', 'project_id', 'customer_id'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
