<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no')->nullable();
            $table->integer('paymentable_id');
            $table->string('paymentable_type');
            $table->string('promotion_id')->nullable();
            $table->decimal('amount',12,2);
            $table->decimal('discount_amount',12,2)->default(0);
            $table->decimal('dollar_amount',12,2)->default(0);
            $table->enum('payment_gateway',['ssl','paypal']);
            $table->string('payment_method');
            $table->integer('credit')->default(0);
            $table->integer('user_id')->index()->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('payments');
    }
}
