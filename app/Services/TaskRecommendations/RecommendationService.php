<?php

namespace App\Services\TaskRecommendations;

use App\Task;
use App\User;

class RecommendationService
{
	/** @var RecommendationEngine */
	private $engine;

	public function __construct(RecommendationEngine $engine)
	{
		$this->engine = $engine;
	}

	public function addRecommendations(User $user, $numItems = 3)
	{
		// Fetch task pool
		$tasks = Task::whereNotNull('parent_id')->get();

		// Fetch recommendations
		$recommendations = $this->engine->recommend($user, $tasks, $numItems);

		// Get task IDs
		$recIds = $recommendations->pluck('task')->pluck('id');

		// Assign recommendations
		$user->recommendedTasks()->attach($recIds);
	}
}
