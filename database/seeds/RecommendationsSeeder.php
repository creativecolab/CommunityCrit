<?php

use App\Task;
use App\User;
use Illuminate\Database\Seeder;

class RecommendationsSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Get all leaves
		$tasks = Task::allLeaves()->get();

		// Get users needing personalization
		$users = User::personalized()->get();

		// Seed recommendations
		foreach ( $users as $user ) {
	    	$user->recommendedTasks()->attach($tasks->random());
		}
	}
}
