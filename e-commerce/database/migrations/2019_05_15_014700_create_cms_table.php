<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('page_url');
            $table->enum('section',['Section 1','Section 2','Section 3','Section 4',
                'Section 5','Section 6','Section 7','Section 8', 'Section 9', 'Section 10']);
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('cms');
    }
}
