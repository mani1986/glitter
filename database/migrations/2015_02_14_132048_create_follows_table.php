<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('follows', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_from');
            $table->foreign('user_from')->references('id')->on('users');
            $table->unsignedInteger('user_to');
            $table->foreign('user_to')->references('id')->on('users');
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
        Schema::drop('follows');
	}

}
