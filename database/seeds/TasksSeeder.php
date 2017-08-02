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
            'text' => 'What would you like to see or do at El Nudillo, the intersection of 14th Street and National Avenue, by yourself or with family and friends?',
            'type' => '80',
        ],
//        [
//            'name' => 'Raise an Issue',
//            'text' => 'What issues relate to this idea?',
//            'type' => '91',
//        ],
        [
            'name' => 'Add a Story',
            'text' => 'Do you have a story or personal experience related to this idea?',
            'type' => '76',
        ],
        [
            'name' => 'Add an Example',
            'text' => 'Can you think of any examples (such as a place or an object) that could inspire the design of this idea?',
            'type' => '75',
        ],
        [
            'name' => 'Improve the Idea',
            'text' => 'How would you improve this idea based on the above reference?',
            'type' => '91',
        ],
        [
            'name' => 'Evaluate Feasability',
            'text' => 'Do you think this idea is feasible? Why or why not?',
            'type' => '101',
        ],
//        [
//            'name' => 'Evaluate Benefit',
//            'text' => 'How might this idea benefit the community?',
//            'type' => '101',
//        ],
//        [
//            'name' => 'Evaluate Values',
//            'text' => 'How well does this idea align with the values of the community?',
//            'type' => '101',
//        ],
        [
            'name' => 'Evaluate Impact: Safety',
            'text' => 'How do you think this idea might impact safety in the area?',
            'type' => '101',
        ],
        [
            'name' => 'Evaluate Impact: Mobility',
            'text' => 'How do you think this idea might impact mobility—from walking or biking to driving and public transit—in the area?',
            'type' => '101',
        ],
        [
            'name' => 'Evaluate Impact: Quality of Life',
            'text' => 'How do you think this idea might impact quality of life in the area?',
            'type' => '101',
        ],
        [
            'name' => 'Critique the Idea',
            'text' => 'The above reference provides a guideline for the design of this idea. What do you think of this idea based on the reference?',
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
