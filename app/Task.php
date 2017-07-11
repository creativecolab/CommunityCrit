<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Baum\Node;
use Illuminate\Database\Eloquent\Model;

class Task extends Node
{

    const TYPE_FACET = 0;
    const TYPE_QUOTE = 1;
    const TYPE_SOURCE = 2;
	const TYPE_SOURCE_QUOTE = 3;

	use CrudTrait;
	use Sluggable;

	protected $fillable = [
		'name',
		'text',
        'type',
		'parent_id',
		'source_id',
	];

    /**
     * Get all facets
     *
     * @return mixed
     */
    public static function getFacets()
    {
        return static::get()->where( 'type',
            static::TYPE_FACET );
    }

    /**
     * Get all sources
     *
     * @return mixed
     */
    public static function getSources()
    {
        return static::get()->where( 'type',
            static::TYPE_SOURCE );
    }

    /**
     * Get all quotes
     *
     * @return mixed
     */
    public static function getQuotes()
    {
        return static::get()->where( 'type',
            static::TYPE_QUOTE );
    }

    /**
     * Get all source text
     *
     * @return mixed
     */
    public static function getSourceText()
    {
        return static::get()->where( 'type',
            static::TYPE_QUOTE,
            static::TYPE_SOURCE_QUOTE );
    }

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
		return $this->hasMany( 'App\Feedback' );
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
    public function facets()
    {
        return $this->belongsToMany( 'App\Task', 'tags', 'quote_id', 'facet_id' );
    }

    public function quotes()
    {
        return $this->belongsToMany('App\Task', 'tags', 'facet_id', 'quote_id');
    }


}
