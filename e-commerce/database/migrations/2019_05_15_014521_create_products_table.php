<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('sku_number')->index();
            $table->integer('category_id')->index()->unsigned();
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');
            $table->longText('description')->nullable();
            $table->decimal('price',14,2)->default(0);
            $table->float('quantity',14,2)->default(0);
            $table->boolean('is_out_of_stock')->default(false);
            $table->boolean('status')->default(true);
            $table->string('meta_tag')->nullable();
            $table->text('meta_description')->nullable();
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
        Schema::dropIfExists('products');
    }
}
