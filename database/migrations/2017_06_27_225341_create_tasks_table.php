<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('text')->nullable();
            $table->text('quote')->nullable();
            $table->tinyInteger('type')->default(1);
//            $table->unsignedInteger('quote_id')->nullable();
//            $table->foreign('quote_id')->references('id')->on('tasks');
            $table->unsignedInteger('source_id')->nullable();
            $table->foreign('source_id')->references('id')->on('tasks');
//            $table->unsignedInteger('facet_id')->nullable();
//            $table->foreign('facet_id')->references('id')->on('tasks');

	        // These columns are needed for Baum's Nested Set implementation to work.
	        // Column names may be changed, but they *must* all exist and be modified
	        // in the model.
	        // Take a look at the model scaffold comments for details.
	        // We add indexes on parent_id, lft, rgt columns by default.
	        $table->integer('parent_id')->nullable()->index();
	        $table->integer('lft')->nullable()->index();
	        $table->integer('rgt')->nullable()->index();
	        $table->integer('depth')->nullable();

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
        Schema::dropIfExists('tasks');
    }
}
