<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModerationToFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->smallInteger('status')->default(0)->after('user_id');
            $table->dateTime('moderated_at')->nullable()->after('status');
            $table->integer('moderated_by')->nullable()->unsigned()->after('moderated_at');
            $table->foreign('moderated_by')->references('id')->on('users');
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
            $table->dropForeign(['moderated_by']);
            $table->dropColumn(['status', 'moderated_at', 'moderated_by']);
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->unsignedInteger('status')->nullable()->after('task_id');
        });
    }
}
