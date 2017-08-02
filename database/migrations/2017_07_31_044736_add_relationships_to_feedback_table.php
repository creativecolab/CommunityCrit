<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feedback', function (Blueprint $table) {
//            $table->unsignedInteger('commentable_id')->nullable();
//            $table->string('commentable_type')->nullable();
            $table->unsignedInteger('idea_id')->nullable()->after('comment');
            $table->foreign('idea_id')->references('id')->on('ideas');
            $table->unsignedInteger('link_id')->nullable()->after('idea_id');
            $table->foreign('link_id')->references('id')->on('links');
            $table->boolean('skipped')->default(false)->after('user_id');
            $table->unsignedInteger('task_id')->nullable()->change();
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
//            $table->dropColumn(['commentable_id', 'commentable_type']);
            $table->unsignedInteger('task_id')->nullable(false)->change();
            $table->dropColumn('skipped');
            $table->dropForeign(['link_id']);
            $table->dropColumn('link_id');
            $table->dropForeign(['idea_id']);
            $table->dropColumn('idea_id');
        });
    }
}