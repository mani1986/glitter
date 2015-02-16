<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlittersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('glitters', function(Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->unsignedInteger('user');
            $table->foreign('user')->references('id')->on('users');
            $table->unsignedInteger('reglitter');
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
        Schema::drop('glitters');
	}

}
