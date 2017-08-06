<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModerationToLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('links', function (Blueprint $table) {
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
        Schema::table('links', function (Blueprint $table) {
            $table->dropForeign(['moderated_by']);
            $table->dropColumn(['status', 'moderated_at', 'moderated_by']);
        });

        Schema::table('links', function (Blueprint $table) {
            $table->unsignedInteger('status')->nullable()->after('user_id');
        });
    }
}
