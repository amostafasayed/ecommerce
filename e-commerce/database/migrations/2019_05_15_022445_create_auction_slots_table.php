<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_slots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('auction_id')->index()->unsigned();
            $table->foreign('auction_id')->references('id')
                ->on('auctions')->onDelete('cascade');
            $table->float('slot_number');
            $table->time('duration_time')->nullable();
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
        Schema::dropIfExists('auction_slots');
    }
}
