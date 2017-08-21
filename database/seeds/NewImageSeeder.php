<?php

use Illuminate\Database\Seeder;
use App\Idea;

class NewImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tower = Idea::where('name', "Build a Tower")->first();
        $tower->img_url = "/img/ideas/tower.jpg";
        $tower->save();

        $fountain = Idea::where('name',"Huge Fountain")->first();
        $fountain->img_url = "/ig/ideas/fountain.png";
        $fountain->save();

        $roundabout = Idea::where('name', "Roundabout")->first();
        $roundabout->img_url = "/img/ideas/roundabout.jpg";
        $roundabout->save();

        $smallpark = Idea::where('name', "EL Parquecito")->first();
        $smallpark->img_url = "/img/ideas/smallPark.jpg";
        $smallpark->save();

        $nuart = Idea::where('name', "Join Nu-Art")->first();
        $nuart->img_url = "/img/ideas/interactiveArt.jpg";
        $nuart->save();
    }
}
