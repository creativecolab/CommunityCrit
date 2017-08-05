<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('task_id');
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->unsignedInteger('idea_id')->nullable();
            $table->foreign('idea_id')->references('id')->on('ideas');
            $table->unsignedInteger('link_id')->nullable();
            $table->foreign('link_id')->references('id')->on('links');
            $table->tinyInteger('action')->nullable();
            $table->unsignedInteger('time_all')->nullable();
            $table->unsignedInteger('time_typing')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_history');
    }
}
