<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugsToTopics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->string('slug')->after('name')->nullable();
        });

        //fill in slugs for existing tasks
        foreach (\App\Topic::all() as $topic)
        {
            $topic->save();
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->after('name')->nullable();
        });

        //fill in slugs for existing tasks
        foreach (\App\Project::all() as $di)
        {
            $di->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
