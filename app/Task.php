<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Baum\Node;
use Illuminate\Database\Eloquent\Model;

class Task extends Node
{
	use CrudTrait;

	protected $fillable = [
		'name',
		'text',
		'parent_id',
	];

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
}
