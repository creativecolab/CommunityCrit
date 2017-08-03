<?php

use App\Task;
use Illuminate\Database\Seeder;

class SourcesSeeder extends Seeder
{
	public $data = [
		[
			'name' => '14th Street Promenade Master Plan',
            'type' => 2
		],
		[
			'name' => 'East Village South Draft Focus Plan',
            'type' => 2
		],
		[
			'name' => 'Barrio Logan Planning Committee Informal Plans',
            'type' => 2
		],
		[
			'name' => 'San Diego Mobility Plan',
            'type' => 2
		],
		[
			'name' => 'Workshop 1 Report',
            'type' => 2
		],
		[
			'name' => 'Workshop 2 Report',
            'type' => 2
		],
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		foreach ( $this->data as $source ) {
			Task::create($source);
	    }
	}
}
