<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sales_id')->index()->unsigned();
            $table->foreign('sales_id')->references('id')
                ->on('sales')->onDelete('cascade');
            $table->integer('product_id')->index()->unsigned();
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade');
            $table->float('quantity')->default(0);
            $table->decimal('unit_price',12,2)->default(0);
            $table->decimal('total_price',12,2)->default(0);
            $table->enum('source',['product','auction']);
            $table->integer('source_id')->nullable();
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
        Schema::dropIfExists('sale_items');
    }
}
