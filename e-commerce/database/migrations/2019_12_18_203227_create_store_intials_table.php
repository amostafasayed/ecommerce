<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreIntialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_intials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('data_1')->nullable();
            $table->string('data_2')->nullable();
            $table->string('data_3')->nullable();
            $table->string('data_4')->nullable();
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
        Schema::dropIfExists('store_intials');
    }
}
