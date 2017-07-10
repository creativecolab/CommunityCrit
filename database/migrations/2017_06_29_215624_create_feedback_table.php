<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type')->nullable();
            $table->text('comment')->nullable();
            $table->text('input1')->nullable();
            $table->text('input2')->nullable();
            $table->text('input3')->nullable();
            $table->unsignedInteger('task_id');
            $table->foreign('task_id')->references('id')->on('tasks');
	        $table->unsignedInteger('user_id');
	        $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('feedback');
    }
}
