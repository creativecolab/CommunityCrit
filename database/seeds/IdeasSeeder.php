<?php

use App\Idea;
use Illuminate\Database\Seeder;

class IdeasSeeder extends Seeder
{
	public $data = [
        [
            'name' => 'Build a tower',
            'text' => 'Build a tower in the center of El Nudillo.',
            'user_id' => 3,
        ],
        [
            'name' => 'Public Art',
            'text' => 'I would love to see El Nudillo, the intersection of 14th Street and National Avenue, become a place for public creative expression. There are so many talented artists around this area, and if we could somehow commission one to make a sculpture or something, or maybe invite everyone to paint a mural one day, it could be an amazing way to make this space ours and bring the community together.',
            'user_id' => 3,
        ],
        [
            'name' => 'Roundabout',
            'text' => 'The intersection right now is basically just an empty lot. We could easily make it a roundabout, so that traffic from National Ave and Commercial St can still get around but so people can also use the open space in the center. If we throw in a few crosswalks and create a welcoming space in the center, a roundabout would be the perfect way to optimize this space for drivers and pedestrians.',
            'user_id' => 3,
        ],
        [
            'name' => 'Huge Fountain',
            'text' => 'So many cities are beautified with fountains! Kids can play in them when it is hot outside, and any sort of water element attracts a crowd. A huge fountain at El Nudillo would make it a destination for people to visit. They could even get food from nearby restaurants and take it there to eat! I know water is scarce in southern California, but I think this is a great opportunity to use it well.',
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
