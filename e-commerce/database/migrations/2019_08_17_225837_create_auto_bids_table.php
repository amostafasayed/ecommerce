<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_bids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->index()->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->integer('auction_id')->index()->unsigned();
            $table->foreign('auction_id')->references('id')
                ->on('auctions')->onDelete('cascade');
            $table->integer('max_bid');
            $table->float('activate_at_price');
            $table->boolean('bid_randomly')->default(0);
            $table->boolean('bid_with_sec')->default(0);

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
        Schema::dropIfExists('auto_bids');
    }
}
