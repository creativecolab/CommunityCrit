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
            'name' => 'Improve the Idea',
            'text' => 'Improve the current idea by suggesting changes or additions that support the reference.',
            'type' => '91',
        ],
        [
            'name' => 'Critique the Idea',
            'text' => 'How well does the current idea align with this reference?',
            'type' => '101',
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
