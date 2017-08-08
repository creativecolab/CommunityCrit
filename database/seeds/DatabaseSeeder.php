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
		// original
		// $this->call( UsersSeeder::class );
		// $this->call( IdeasSeeder::class );
		// $this->call( TasksSeeder::class );
		// $this->call( LinksSeeder::class );
		// $this->call( FeedbackSeeder::class );

		// new
		$this->call( QuestionsSeeder::class );
		$this->call( TasksSeeder2::class );
		
		// deprecated
		// $this->call( FacetsSeeder::class );
		// $this->call( sourceIdSeeder::class );
		// $this->call( SourcesSeeder::class );
		// $this->call( RecommendationsSeeder::class );
        // $this->call( TagsSeeder::class );
	}
}