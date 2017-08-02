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
            'comment' => 'A structure or monument at the Nudillo could incorporate an audio component: When the California Tower play chimes, the chimes could emanate from there as well.',
			'user_id' => 3,
			'idea_id' => 1,
        ],
        [
            'comment' => 'The built form should be lit at night.',
			'user_id' => 3,
			'idea_id' => 1,
        ],
        [
            'comment' => 'More than a plaza, the space can be activated through landscape, a place for food trucks nearby, and implementing a tower structure to memorialize the view/connection to Balboa Park.',
			'user_id' => 3,
			'idea_id' => 1,
        ],
        [
            'comment' => 'The structure could incorporate an observation deck. It could echo the tower elements of the California Tower (which is visible from the Nudillo) and the MTS clock tower.',
			'user_id' => 3,
			'idea_id' => 1,
        ],
        [
            'comment' => 'This could be an obelisk or major art piece authored by Barrio artists.',
			'user_id' => 3,
			'idea_id' => 2,
        ],
        [
            'comment' => 'It is envisioned as a small traffic roundabout with a major art piece in the center in the spirit of Tijuana or Mexico City.',
			'user_id' => 3,
			'idea_id' => 2,
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

		 foreach ( $this->data as $feedback ) {
             Feedback::create($feedback);
         }
	}
}
