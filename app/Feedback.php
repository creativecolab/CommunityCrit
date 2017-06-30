<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
	use CrudTrait;

	protected $fillable = [ 'comment', 'task_id', 'user_id' ];

	/**
	 * Task for this comment
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function task()
	{
		return $this->belongsTo('App\Task');
	}

	/**
	 * User who made this comment
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
