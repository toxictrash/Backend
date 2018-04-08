<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OverwatchVodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overwatch_vod', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('player_id')->unsigned();
            $table->string('youtube_id')->unique();
            $table->string('youtube_thumbnail');
            $table->string('youtube_title');
            $table->string('youtube_duration');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('overwatch_vod');
    }
}
