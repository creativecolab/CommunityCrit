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
        $tower = Idea::where('name', "Build a Tower")->get();
        $tower->img_url = "/img/ideas/tower.jpg";
        $tower->save();

        $fountain = Idea::where('name',"Huge Fountain")->get();
        $fountain->img_url = "/ig/ideas/fountain.png";
        $fountain->save();

        $roundabout = Idea::where('name', "Roundabout")->get();
        $roundabout->img_url = "/img/ideas/roundabout.jpg";
        $roundabout->save();

        $smallpark = Idea::where('name', "EL Parquecito")->get();
        $smallpark->img_url = "/img/ideas/smallPark.jpg";
        $smallpark->save();

        $nuart = Idea::where('name', "Join Nu-Art")->get();
        $nuart->img_url = "/img/ideas/interactiveArt.jpg";
        $nuart->save();
    }
}
