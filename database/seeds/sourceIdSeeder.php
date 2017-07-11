<?php

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
        $affected = DB::update('update tasks set source_id = 25 where type = ?', ['1']);
    }
}
