<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Redis;
use Glitter\Hashtag;

class CreateHashtagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('hashtags', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('glitter');
            $table->foreign('glitter')->references('id')->on('glitters');
            $table->timestamps();
        });

        Redis::set(Hashtag::REDIS_KEY_HASHTAG_LATEST, json_encode([]));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('hashtags');
	}

}
