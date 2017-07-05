<?php

use App\Source;
use Illuminate\Database\Seeder;

class SourcesSeeder extends Seeder
{
	public $data = [
		[
			'name' => '14th Street Promenade Master Plan',
		],
		[
			'name' => 'East Village South Draft Focus Plan'
		],
		[
			'name' => 'Barrio Logan Planning Committee Informal Plans'
		],
		[
			'name' => 'San Diego Mobility Plan'
		],
		[
			'name' => 'Workshop 1 Report'
		],
		[
			'name' => 'Workshop 2 Report'
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
			Source::create($source);
	    }
	}
}
