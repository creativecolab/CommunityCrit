<?php

namespace App\Services\TaskRecommendations;

use App\Task;
use App\User;
use Illuminate\Support\Collection;

class RandomEngine implements RecommendationEngine
{
	/**
	 * {@inheritdoc}
	 * This is a fake engine and uses mt_rand() to generate a random score for each task.
	 *
	 * @param User $user
	 * @param $tasks
	 * @param $numItems Number of recommendations to return
	 *
	 * @return Collection Tasks and their scores
	 */
	public function recommend( User $user, $tasks, $numItems = null )
	{
		// Instantiate scores collection
		$scores = new Collection();

		// Score each task
		foreach ( $tasks as $task ) {
			$scores->push( $this->score( $user, $task ) );
		}

		// Return collection of recommendations
		$sorted = $scores->sortByDesc( 'score' );
		if ( $numItems ) {
			return $sorted->take( $numItems );
		} else {
			return $sorted;
		}
	}

	/**
	 * Generates random scores for each task
	 *
	 * @param User $user
	 * @param Task $task
	 *
	 * @return array
	 */
	protected function score( User $user, Task $task )
	{
		return [
			'task'  => $task,
			'score' => mt_rand() / mt_getrandmax()
		];
	}
}
