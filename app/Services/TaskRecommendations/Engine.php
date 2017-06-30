<?php

namespace app\Services\TaskRecommendations;

use App\User;

interface Engine
{
	/**
	 * Return a scored list of tasks based on user.
	 *
	 * @param User $user
	 * @param $tasks
	 * @param $numItems
	 *
	 * @return mixed
	 */
	public function recommend( User $user, $tasks, $numItems = null );
}