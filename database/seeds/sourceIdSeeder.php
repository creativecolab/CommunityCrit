<?php

use App\Task;
use Illuminate\Database\Seeder;

class sourceIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $affected = DB::update('update tasks set source_id = 25 where type = ?', ['1']);
        $sources = Task::getSources();
        foreach ($sources as $source) {
            foreach ($source->descendants()->get() as $quote) {
//                $quote->source_id = $source->id;
                $affected = DB::update('update tasks set source_id = ? where id = ?', [$source->id,$quote->id]);
            }
        }
    }
}
