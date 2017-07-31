<?php

namespace App;

use Carbon\Carbon;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class Idea extends Node
{
    use CrudTrait;

    protected $fillable = [
        'text',
        'name',
        'user_id'
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

    // public function tasks()
    // {
    //     return $this->belongsToMany( 'App\Task' );
    // }

    public function feedback()
    {
        return $this->hasMany( 'App\Feedback' );
        // return $this->morphMany('App\Feedback', 'commentable');
    }

    public function diffForHumans($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }

    public function readableDate($date)
    {
        $date = $date->setTimezone('America/Los_Angeles');
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('F jS, Y, g:i a');
    }
}
