<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OverwatchPlayerRankingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overwatch_players_ranking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id')->unsigned()->unique();
            $table->integer('player_ranking')->unsigned()->default(0);
            $table->integer('player_prestige')->unsigned()->default(0);
            $table->integer('player_level')->unsigned()->default(0);
            $table->string('player_current_tier')->nullable()->default('unranked')->comment('Players current Tier');
            $table->string('player_should_tier')->nullable()->default('unranked')->comment('Players should be Tier because to less points');
            $table->string('player_avatar')->nullable();
            $table->integer('player_medals_total')->unsigned()->default(0);
            $table->integer('player_medals_gold')->unsigned()->default(0);
            $table->integer('player_medals_silver')->unsigned()->default(0);
            $table->integer('player_medals_bronze')->unsigned()->default(0);
            $table->integer('player_games_total')->unsigned()->default(0);
            $table->integer('player_games_won')->unsigned()->default(0);
            $table->integer('player_games_draw')->unsigned()->default(0);
            $table->integer('player_games_lose')->unsigned()->default(0);
            $table->integer('player_healing_done')->unsigned()->default(0);
            $table->integer('player_damage_done')->unsigned()->default(0);
            $table->integer('player_kills')->unsigned()->default(0);
            $table->integer('player_deaths')->unsigned()->default(0);
            $table->string('player_kpd')->default('0');
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
        Schema::drop('overwatch_players_ranking');
    }
}
