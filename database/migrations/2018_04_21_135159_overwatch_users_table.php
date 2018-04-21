<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OverwatchUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overwatch_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'username' )->unique();
            $table->string( 'slug' );
            $table->string( 'email' )->unique();
            $table->string( 'password' );
            $table->string( 'player_role' );
            $table->enum('active', ['0', '1'])->default('0');
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
        Schema::drop('overwatch_users');
    }
}
