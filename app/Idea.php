<?php

namespace App;

use Carbon\Carbon;
use Backpack\CRUD\CrudTrait;
// use Hootlex\Moderation\Moderatable;
use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class Idea extends Node
{
    const STATUSES = [
        1 => 'approved',
        2 => 'unapproved',
    ];

    // use Moderatable;
    use CrudTrait;

    protected $fillable = [
        'text',
        'name',
        'old_name',
        'user_id',
        'status',
        'moderated_at',
        'moderated_by'
    ];

    public function links()
    {
        return $this->hasMany( 'App\Link' );
    }

    public function questions()
    {
        return $this->hasMany( 'App\Question' );
    }

    // public function hasLinks()
    // {
    //     return count($this->hasMany( 'App\Link' ));
    // }

    public function comments()
    {
        return $this->hasMany( 'App\Comment' );
    }

    public function ratings()
    {
        return $this->hasMany( 'App\Rating' );
    }

    public function linkTasks()
    {
        return $this->hasManyThrough('App\Task', 'App\Link', 'idea_id', 'id', 'id');
    }

    public function feedbackTasks()
    {
        return $this->hasManyThrough('App\Task', 'App\Feedback', 'idea_id', 'id', 'id');
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

    public function user()
    {
        return $this->belongsTo( 'App\User' );
    }

    /**
     * taskHists this idea is attached to
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taskHist()
    {
        return $this->hasMany( 'App\TaskHist' );
    }
}
