<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OverwatchPlayerTrendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overwatch_players_trends', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id')->unsigned();
            $table->integer('player_ranking')->unsigned();
            $table->string('player_tier')->nullable()->default('unranked');
            $table->integer('player_games_total')->unsigned()->default(0);
            $table->integer('player_games_won')->unsigned()->default(0);
            $table->integer('player_games_draw')->unsigned()->default(0);
            $table->integer('player_games_lose')->unsigned()->default(0);
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
        Schema::drop('overwatch_players_trends');
    }
}
