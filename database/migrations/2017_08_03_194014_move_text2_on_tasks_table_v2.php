<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveText2OnTasksTableV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('text2');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->text('text2')->nullable()->after('text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('text2');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->text('text2')->nullable()->after('updated_at');
        });
    }
}