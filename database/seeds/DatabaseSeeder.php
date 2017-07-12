<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call( UsersSeeder::class );
		$this->call( FacetsSeeder::class );
		$this->call( SourcesSeeder::class );
		$this->call( TasksSeeder::class );
		$this->call( FeedbackSeeder::class );
		$this->call( RecommendationsSeeder::class );
        $this->call( TagsSeeder::class );
	}
}
