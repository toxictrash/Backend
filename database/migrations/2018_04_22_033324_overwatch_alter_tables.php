<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OverwatchAlterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('overwatch_players', function($table) {
            $table->integer('user_id')->nullable()->unsigned()->after('id');
        });

        Schema::table('overwatch_vod', function($table) {
            $table->integer('user_id')->nullable()->unsigned()->after('id');
        });

        Schema::table('overwatch_guides', function($table) {
            $table->integer('user_id')->nullable()->unsigned()->after('id');
        });

        Schema::table('overwatch_news', function($table) {
            $table->integer('user_id')->nullable()->unsigned()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('overwatch_players', function($table) {
            $table->dropColumn('user_id');
        });

        Schema::table('overwatch_vod', function($table) {
            $table->dropColumn('user_id');
        });

        Schema::table('overwatch_guides', function($table) {
            $table->dropColumn('user_id');
        });

        Schema::table('overwatch_news', function($table) {
            $table->dropColumn('user_id');
        });
    }
}
