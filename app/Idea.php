<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class Idea extends Node
{
    use CrudTrait;

    protected $fillable = [
        'text',
    ];

    public function links()
    {
        return $this->hasMany( 'App\Link' );
    }

    public function comments()
    {
        return $this->hasMany( 'App\Comment' );
    }

    public function ratings()
    {
        return $this->hasMany( 'App\Rating' );
    }

    public function tasks()
    {
        return $this->belongsToMany( 'App\Task' );
    }

    public function feedback()
    {
        return $this->morphMany('App\Feedback', 'commentable');
    }
}
