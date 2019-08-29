<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'content', 'user_id'
    ];

    protected $dates = ['deleted_at'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
