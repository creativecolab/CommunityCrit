<?php

use App\Task;
use Illuminate\Database\Seeder;

class TasksSeeder4 extends Seeder
{
    /**
     * Data to create
     *
     * @var array
     */
    public $data = [
	    [
            'name' => 'Evaluate Impact: Safety',
            'text' => 'How do you think this idea might impact safety in the area?',
            'type' => '103',
        ],
        [
            'name' => 'Evaluate Impact: Mobility',
            'text' => 'How do you think this idea might impact mobility—from walking or biking to driving and public transit—in the area?',
            'type' => '103',
        ],
        [
            'name' => 'Evaluate Impact: Quality of Life',
            'text' => 'How do you think this idea might impact quality of life in the area?',
            'type' => '103',
        ],
	    [
            'name' => 'Rate the Idea',
            'text' => 'Rate this idea across the following dimensions.',
            'type' => '104',
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
