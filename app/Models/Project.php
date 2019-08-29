<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'start_date', 'end_date', 'customer_id'
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
