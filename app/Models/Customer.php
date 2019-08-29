<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'address', 'phone', 'password'
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
