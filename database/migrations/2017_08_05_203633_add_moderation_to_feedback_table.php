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
        Schema::hasColumn('feedback', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->smallInteger('status')->default(0)->after('user_id');
            $table->dateTime('moderated_at')->nullable()->after('status');
            //If you want to track who moderated the Model add 'moderated_by' too.
            $table->integer('moderated_by')->nullable()->unsigned()->after('moderated_at');
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
            $table->dropColumn('status');
            $table->dropColumn('moderated_at');
            $table->dropColumn('moderated_by');
        });

        Schema::table('feedback', function (Blueprint $table) {
            $table->unsignedInteger('status')->nullable()->after('task_id');
        });
    }
}
