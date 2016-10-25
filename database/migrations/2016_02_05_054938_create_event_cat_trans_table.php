<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCatTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_cat_trans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("event_cat_id")->unsigned();
            $table->foreign('event_cat_id')->references('id')->on('event_cat')->onDelete('cascade');
            $table->integer("lang_id")->unsigned();
            $table->foreign('lang_id')->references('id')->on('langs');
            $table->string("title");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_cat_trans');
    }
}
