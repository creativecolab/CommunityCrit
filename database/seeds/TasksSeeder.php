<?php

use App\Task;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Data to create
     *
     * @var array
     */
    public $data = [
	    [
            'name' => 'Comment on the Idea',
            'text' => 'Add a comment on this idea.',
            'type' => '20',
        ],
        [
            'name' => 'Submit an Idea',
            'text' => 'What would you like to see or do at El Nudillo, the intersection of 14th Street and National Avenue?',
            'type' => '80',
        ],
        [
            'name' => 'Report a Related Issue',
            'text' => 'What challenges have you observed that relate to this idea?',
            'type' => '91',
        ],
        [
            'name' => 'Add a Story',
            'text' => 'Tell a story that relates to this idea.',
            'type' => '91',
        ],
        [
            'name' => 'Add an Example',
            'text' => 'Describe something that already exists that relates to this idea.',
            'type' => '91',
        ],
        [
            'name' => 'Improve the Idea',
            'text' => 'Improve the current idea by suggesting changes or additions that support the reference.',
            'type' => '91',
        ],
        [
            'name' => 'Evaluate Feasability',
            'text' => 'How feasible is this idea?',
            'type' => '101',
        ],
        [
            'name' => 'Evaluate Benefit',
            'text' => 'How might this idea benefit the community?',
            'type' => '101',
        ],
        [
            'name' => 'Evaluate Values',
            'text' => 'How does this idea relate to the values of the surrounding community?',
            'type' => '101',
        ],
        [
            'name' => 'Evaluate Impact: Safety',
            'text' => 'How might this idea impact safety in this area?',
            'type' => '101',
        ],
        [
            'name' => 'Evaluate Impact: Traffic',
            'text' => 'How might this idea impact traffic in this area?',
            'type' => '101',
        ],
        [
            'name' => 'Evaluate Impact: Quality of Life',
            'text' => 'How might this idea impact quality of life in this area?',
            'type' => '101',
        ],
        [
            'name' => 'Critique the Idea',
            'text' => 'How well does the current idea align with this reference?',
            'type' => '102',
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ( $this->data as $task ) {
            Task::create($task);
        }
    }
}
