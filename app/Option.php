<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['text'];

    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }
}
