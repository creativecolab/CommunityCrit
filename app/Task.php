<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Baum\Node;
use Illuminate\Database\Eloquent\Model;

class Task extends Node
{
    const TYPE_TEXT = 1;
    const TYPE_RADIO = 2;
    const TYPE_IMAGE = 3;
    const TYPE_CHECKBOX = 4;
    const TYPE_MULTITEXT = 5;

    const TYPE_EVAL = [100 => 'rating', 101 => 'text', 102 => 'text_link'];
    const TYPE_IMPROVE = [90 => 'no_link', 91 => 'link'];
    const TYPE_SUBMIT = [80 => 'idea', 81 => 'link'];
    const TYPES = ['eval' => Task::TYPE_EVAL, 'improve' => Task::TYPE_IMPROVE, 'submit' => Task::TYPE_SUBMIT];

    use CrudTrait;
    use Sluggable;

    protected $fillable = [
        'name',
        'text',
        'type',
//        'task_id',
        'parent_id',
        'source_id',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Returns whether or not the Task has subtasks
     *
     * @return bool
     */
    public function hasSubtasks()
    {
        return $this->subtasks->isNotEmpty();
    }

    /**
     * Gets all subtasks
     *
     * @return mixed
     */
    public function subtasks()
    {
        return $this->children()->get();
    }

    /**
     * Feedback for this task
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedback()
    {
//		return $this->hasMany( 'App\Feedback' );
        return $this->morphMany( 'App\Feedback', 'commentable');
    }

    /**
     * Users recommended to this task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recommendedUsers()
    {
        return $this->belongsToMany('App\User', 'recommendations')->withTimestamps();
    }

    /**
     * Source of the task information (if exists)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source()
    {
        return $this->belongsTo('App\Task', 'source_id');
    }

    /**
     * Quotes for this source
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sourceHasQuotes()
    {
        return $this->hasMany('App\Task', 'source_id');
    }

    /**
     * Facets for this task
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topic()
    {
        return $this->belongsTo( 'App\Topic' );
    }

    public function project()
    {
        return $this->belongsTo( 'App\Project' );
    }

    public function options()
    {
        return $this->belongsToMany('App\Option');
    }

    public function ideas()
    {
        return $this->belongsToMany( 'App\Idea' );
    }

//    public function links()
//    {
//        return $this->hasManyThrough('App\Link', 'App\Idea');
//    }
}
