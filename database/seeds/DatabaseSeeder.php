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
		$this->call( QuestionsSeeder::class );
		// $this->call( UsersSeeder::class );
		// $this->call( IdeasSeeder::class );
		//$this->call( SourcesSeeder::class );
		// $this->call( TasksSeeder::class );
		// $this->call( LinksSeeder::class );
		// $this->call( FacetsSeeder::class );
		// $this->call( sourceIdSeeder::class );
		// $this->call( FeedbackSeeder::class );
		// $this->call( RecommendationsSeeder::class );
        // $this->call( TagsSeeder::class );
	}
}