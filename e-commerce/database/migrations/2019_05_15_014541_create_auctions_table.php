<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->index()->unsigned();
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade');
            $table->string('name')->index();
            $table->longText('description')->nullable();
            $table->float('price_drop_percentage')->default(0);
            $table->float('starting_price')->default(0);
            $table->enum('auction_type',['Paid','Free']);
            $table->float('cost_per_bid')->default(0);
            $table->float('price_increase_every_bid')->default(0);
            $table->timestamp('up_time')->nullable();
            $table->text('duration_time_range')->nullable();
            $table->enum('status',['Active','Inactive','Pause']);
            $table->boolean('is_closed')->default(false);
            $table->decimal('closed_amount',10,2)->default(0);
            $table->timestamp('re_open_time')->nullable();
            $table->string('image')->nullable();

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
        Schema::dropIfExists('auctions');
    }
}
