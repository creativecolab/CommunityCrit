<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMorphToFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->unsignedInteger('commentable_id')->nullable();
            $table->string('commentable_type')->nullable();
            $table->dropForeign(['task_id']);
            $table->dropColumn('task_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->dropColumn(['commentable_id', 'commentable_type']);
            $table->unsignedInteger('task_id');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }
}
