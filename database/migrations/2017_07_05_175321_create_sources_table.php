<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rank')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->text('link')->nullable();
            $table->timestamps();
        });

//        Schema::table('tasks', function (Blueprint $table) {
//	        $table->unsignedInteger('source_id')->nullable()->after('text');
//	        $table->foreign('source_id')->references('id')->on('sources');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('tasks', function (Blueprint $table) {
    		$table->dropForeign( 'tasks_source_id_foreign' );
    		$table->dropColumn([ 'source_id' ]);
	    });
        Schema::dropIfExists('sources');
    }
}
