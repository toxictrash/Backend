<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuctioneerAuctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wow_auctions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->string('owner');
            $table->string('ownerRealm');
            $table->string('slug', 255)->unique();
            $table->longText('bid');
            $table->longText('buyout');
            $table->integer('quantity')->unsigned();
            $table->string('timeLeft');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('wow_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->string('title');
            $table->string('slug', 255)->unique();
            $table->text('description');
            $table->string('icon');
            $table->integer('quality')->unsigned();
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
        Schema::drop('wow_auctions');
        Schema::drop('wow_items');
    }
}
