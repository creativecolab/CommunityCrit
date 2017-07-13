<?php

use App\Task;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tasks = Task::getQuotes();
        for ($x = 0; $x <= 1; $x++) {
            foreach ($tasks as $task) {
                DB::table('tags')->insert([
                    'quote_id' => $task->id,
                    'facet_id' => Task::getFacets()->random()->id,
                ]);
            }
        }
    }
}
