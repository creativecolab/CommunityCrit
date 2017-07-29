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
            'text' => '<strong>City of San Diego General Plan<strong></br>Compact and walkable mixed-use villages of different scales within communities',
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
