<?php

use App\Question;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Data to create
     *
     * @var array
     */
	public $data = [
	    [
            'text' => 'What color(s) would you want a tower at El Nudillo to be?',
			'idea_id' => 1,
			'user_id' => 3,
			'status' => 1,
        ],
	    [
            'text' => 'What artist(s) would you recommend to create artwork at El Nudillo?',
			'idea_id' => 2,
			'user_id' => 3,
			'status' => 1,
        ],
    	[
            'text' => 'How many crosswalks do you think a roundabout at El Nudillo should have?',
			'idea_id' => 3,
			'user_id' => 3,
			'status' => 1,
        ],
        [
            'text' => 'Do you think people should be able to play in a fountain at El Nudillo? Why or why not?',
			'idea_id' => 4,
			'user_id' => 3,
			'status' => 1,
        ],
    ];
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		foreach ( $this->data as $feedback ) {
			Question::create($feedback);
		}
	}
}
