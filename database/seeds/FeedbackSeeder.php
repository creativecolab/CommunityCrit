<?php

use App\Feedback;
use App\Task;
use App\User;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
	/**
     * Data to create
     *
     * @var array
     */
	public $data = [
	    [
            'comment' => 'This is feedback on something that is talking about it.'
			'user_id' => 1,
			'type' => 1
        ],
        [
            'comment' => 'This is feedback on something that is talking about it.'
			'user_id' => 1,
			'type' => 1
        ],
        [
            'comment' => 'This is feedback on something that is talking about it.'
			'user_id' => 1,
			'type' => 1
        ],
        [
            'comment' => 'This is feedback on something that is talking about it.'
			'user_id' => 1,
			'type' => 1
        ],
        [
            'comment' => 'This is feedback on something that is talking about it.'
			'user_id' => 1,
			'type' => 1
        ],
    ];
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// // HOLISTIC SEED
		// $rootTask = Task::root();

		// // Get holistic users
		// $holisticUsers = User::holistic()->get();

		// // Create feedback for holistic condition
		// foreach ( $holisticUsers as $user ) {
		// 	factory( Feedback::class )->create( [ 'user_id' => $user->id, 'task_id' => $rootTask->id, 'type' => 'custom' ] );
		// }


		// // MICROTASK SEEDS
		// // Get non-root tasks
		// $tasks = Task::whereNotNull( 'parent_id' )->get();

		// // Get microtask users
		// $microtaskUsers = User::microtask()->get();

		// // Create 1 feedback item for each user
		// foreach ( $microtaskUsers as $user ) {
		// 	factory( Feedback::class )->create( [ 'user_id' => $user->id, 'task_id' => $tasks->random()->id, 'type' => 'custom'  ] );
		// }

		// factory(Feedback::class, 5)->create();

		foreach ( $this->data as $user ) {
            User::create($user);
        }
	}
}
