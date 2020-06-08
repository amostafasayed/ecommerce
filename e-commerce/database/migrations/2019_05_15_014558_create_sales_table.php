<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_no')->index();
            $table->integer('user_id')->index();
            $table->string('user_name')->index();
            $table->string('mobile');
            $table->string('post_code')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->text('address')->nullable();
            $table->decimal('discount')->default(0);
            $table->decimal('shipping_cost')->default(0);
            $table->enum('payment_type',['cash on delivery', 'ssl', 'paypal']);
            $table->enum('order_status',['On Process', 'Shipped', 'Delivered', 'Cancel']);
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
        Schema::dropIfExists('sales');
    }
}
