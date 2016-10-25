<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventGallery extends Migration
{
    public function up()
    {
        Schema::create('event_gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("event_id")->unsigned();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->string('path');
            $table->tinyInteger("put_in_gallery")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_gallery');
    }
}
