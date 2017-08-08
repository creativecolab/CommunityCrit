<?php

use App\Task;
use Illuminate\Database\Seeder;

class TasksSeeder2 extends Seeder
{
    /**
     * Data to create
     *
     * @var array
     */
    public $data = [
	    [
            'name' => "Answer Someone Else's Question",
            'text' => 'Woops! It looks like the question was not retrieved correctly. Skip to the next activity.',
            'type' => '61',
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
