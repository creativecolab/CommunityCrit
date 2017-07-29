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
            'name' => 'Improve an Idea',
            'text' => 'Build a tower that jumps along the way and is in the center of the intersection.',
            'type' => '91',
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
