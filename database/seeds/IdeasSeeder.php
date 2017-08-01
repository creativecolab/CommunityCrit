<?php

use App\Idea;
use Illuminate\Database\Seeder;

class IdeasSeeder extends Seeder
{
	public $data = [
        [
            'name' => 'Build a tower',
            'text' => 'Build a tower in the center of El Nudillo, the intersection of 14th Street and National Avenue.',
            'user_id' => 3,
        ],
        [
            'name' => 'Public Art',
            'text' => 'Make El Nudillo, the intersection of 14th Street and National Avenue, a place for public creative expression.',
            'user_id' => 3,
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
