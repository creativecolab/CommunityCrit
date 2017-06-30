<?php

namespace App\Services\TaskRecommendations;

use App\User;

interface RecommendationEngine
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