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
            'img_url' => 'https://s-media-cache-ak0.pinimg.com/originals/39/94/b8/3994b8d9e20f74b6165409de477e8092.jpg'
        ],
        [
            'name' => 'Public Art',
            'text' => 'I would love to see El Nudillo, the intersection of 14th Street and National Avenue, become a place for public creative expression. There are so many talented artists around this area, and if we could somehow commission one to make a sculpture or something, or maybe invite everyone to paint a mural one day, it could be an amazing way to make this space ours and bring the community together. Art pieces could be rotated in and out, and maybe there could be an event held for the unveiling of each new piece.',
            'user_id' => 3,
            'img_url' => 'https://www.signmedia.ca/wp-content/uploads/2014/12/prismatica.jpg'
        ],
        [
            'name' => 'Roundabout',
            'text' => 'The intersection right now is basically just an empty lot. We could easily make it a roundabout with three crosswalks so that traffic from National Ave and Commercial St can still get around but so people can also use the open space in the center.',
            'user_id' => 3,
            'img_url' => 'https://bethineurope.files.wordpress.com/2015/07/img_1239.jpg'
        ],
        [
            'name' => 'Huge Fountain',
            'text' => 'So many cities are beautified with fountains! Kids can play in them when it is hot outside, and any sort of water element attracts a crowd. A huge fountain at El Nudillo would make it a destination for people to visit. They could even get food from nearby restaurants and take it there to eat! I know water is scarce in southern California, but I think this is a great opportunity to use it well.',
            'user_id' => 3,
            'img_url' => 'http://static.panoramio.com/photos/large/78891065.jpg'
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
