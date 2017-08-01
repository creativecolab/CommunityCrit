<?php

use App\Task;
use Illuminate\Database\Seeder;

class FacetsSeeder extends Seeder
{
    public $data = [
        [
            'name' => 'Planting',
            'type' => 0,
        ],
        [
            'name' => 'Lighting',
            'type' => 0,
        ],
        [
            'name' => 'Facet3',
            'type' => 0,
        ],
        [
            'name' => 'Facet4',
            'type' => 0,
        ],
        [
            'name' => 'Facet5',
            'type' => 0,
        ],
        [
            'name' => 'Facet6',
            'type' => 0,
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ( $this->data as $facet ) {
            Task::create($facet);
        }
    }
}
