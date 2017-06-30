<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
        	$table->increments('id');
	        $table->unsignedInteger('task_id');
	        $table->foreign('task_id')->references('id')->on('tasks');
	        $table->unsignedInteger('user_id');
	        $table->foreign('user_id')->references('id')->on('users');
	        $table->decimal('score')->nullable();
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
        Schema::dropIfExists('recommendations');
    }
}
