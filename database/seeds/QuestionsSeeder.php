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
            'text' => 'What artists would you recommend to create this artwork?',
			'idea_id' => 2,
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