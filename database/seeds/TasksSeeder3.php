<?php

use App\Task;
use Illuminate\Database\Seeder;

class TasksSeeder3 extends Seeder
{
    /**
     * Data to create
     *
     * @var array
     */
    public $data = [
	    [
            'name' => "Ask A Question",
            'text' => 'Submit a question you want to ask other community members about this idea.',
            'type' => '62',
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
