<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuesIdToTaskHistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_history', function (Blueprint $table) {
            $table->unsignedInteger('ques_id')->nullable()->after('link_id');
            $table->foreign('ques_id')->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_history', function (Blueprint $table) {
            $table->dropForeign(['ques_id']);
            $table->dropColumn('ques_id');
        });
    }
}
