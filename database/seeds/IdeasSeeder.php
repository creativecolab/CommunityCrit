<?php

use App\Idea;
use Illuminate\Database\Seeder;

class IdeasSeeder extends Seeder
{
	public $data = [
        [
            'name' => 'Build a tower',
            'text' => 'Build a tower in the center of the intersection.',
            'user_id' => 1,
        ],
        [
            'name' => 'Connection Point',
            'text' => 'Use El Nudillo as a connection between East Village and Barrio Logan.',
            'user_id' => 1,
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ( $this->data as $idea ) {
            Idea::create($idea);
        }
    }
}
