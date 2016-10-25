<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCatTable extends Migration
{
    public function up()
    {
        Schema::create('event_cat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ge_title');
            $table->string('en_title');
            $table->string('ru_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_cat');
    }
}
