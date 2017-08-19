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

    // types equal to or greater than 50 are included in the queue
    const TYPE_EVAL = [100 => 'rating', 101 => 'text', 102 => 'text_link', 103 => 'rate_text', 104 => 'multi_rate_text'];
    const TYPE_IMPROVE = [90 => 'no_link', 91 => 'link'];
    const TYPE_LINK = [71 => 'design_guideline', 72 => 'project_goal', 73 => 'project_constraint', 74 => 'issue', 75 => 'example', 76 => 'story'];
    const TYPE_SPECIFIC = [61 => 'respond', 62 => 'question'];
    // types less than 50 are not included in the queue

    const TYPE_COMMENT = [20 => 'comment'];
    const TYPE_SUBMIT = [40 => 'idea', 41 => 'link'];

    const TYPES = ['eval' => Task::TYPE_EVAL, 'link' => Task::TYPE_LINK, 'improve' => Task::TYPE_IMPROVE, 'submit' => Task::TYPE_SUBMIT, 'comment' => Task::TYPE_COMMENT];
    
    const FORMAT_RATE = [100];
    const FORMAT_RATEWTEXT = [103, 104];
    const FORMAT_TEXT = [101, 90, 40, 71, 72, 73, 74, 75, 76, 20, 61, 62];
    const FORMAT_TEXTWLINK = [102, 91, 41];
    const FORMATS = ['rate' => Task::FORMAT_RATE, 'text' => Task::FORMAT_TEXT, 'text_link' => Task::FORMAT_TEXTWLINK, 'rate_text' => Task::FORMAT_RATEWTEXT];
    

    use CrudTrait;
    use Sluggable;

    protected $fillable = [
        'name',
        'text',
        'type',
//        'task_id',
        'parent_id',
        'source_id',
        'hidden',
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

    // *
    //  * Return a task type ID when given a category.
    //  *
    //  * @return array
     
    // public function findByType()
    // {
    //     return static::TYPES->get('link');
    // }

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
        return $this->hasMany( 'App\Feedback' );
        // return $this->morphMany( 'App\Feedback', 'commentable');
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

    // public function ideas()
    // {
    //     return $this->belongsToMany( 'App\Idea' );
    // }

//    public function links()
//    {
//        return $this->hasManyThrough('App\Link', 'App\Idea');
//    }
}
