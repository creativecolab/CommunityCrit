<?php

use App\Link;
use Illuminate\Database\Seeder;

class LinksSeeder extends Seeder
{
	public $data = [
        [
            'type' => '1',
            'image' => '0',
            'link_type' => '1',
            'text' => '<strong>City of San Diego General Plan</strong></br>Compact and walkable mixed-use villages of different scales within communities',
            'idea_id' => '1',
            'user_id' => '1',
            'hidden' => '0',
        ],
        [
            'type' => '1',
            'image' => '0',
            'link_type' => '5',
            'text' => 'A tower is a tall structure, taller than it is wide, often by a significant margin. Towers are distinguished from masts by their lack of guy-wires and are therefore, along with tall buildings, self-supporting structures.',
            'idea_id' => '1',
            'user_id' => '1',
            'hidden' => '0',
        ],
        [
            'type' => '1',
            'image' => '0',
            'link_type' => '4',
            'text' => 'I cannot see California Tower because I am short.',
            'idea_id' => '1',
            'user_id' => '1',
            'hidden' => '0',
        ],
        [
            'type' => '1',
            'image' => '0',
            'link_type' => '2',
            'text' => 'Create a memorable and major public open space or series of open spaces to anchor an “innovation district.” Pocket parks and/or green spaces must punctuate the neighborhood.',
            'idea_id' => '1',
            'user_id' => '1',
            'hidden' => '0',
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ( $this->data as $link ) {
            Link::create($link);
        }
    }
}
