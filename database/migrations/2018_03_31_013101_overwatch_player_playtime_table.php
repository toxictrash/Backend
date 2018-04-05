<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OverwatchPlayerPlaytimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overwatch_players_playtime', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id')->unsigned();
            $table->string('character_name');
            $table->double('character_time')->default(0);
            $table->string('character_role');
            $table->integer('character_kills')->unsigned()->default(0);
            $table->integer('character_deaths')->unsigned()->default(0);
            $table->integer('character_healing_done')->unsigned()->default(0);
            $table->integer('character_damage_done')->unsigned()->default(0);
            $table->integer('character_games_played')->unsigned()->default(0);
            $table->integer('character_games_won')->unsigned()->default(0);
            $table->integer('character_games_lost')->unsigned()->default(0);
            $table->integer('character_games_draw')->unsigned()->default(0);
            $table->integer('character_winrate')->unsigned()->default(0);
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
        Schema::drop('overwatch_players_playtime');
    }
}
