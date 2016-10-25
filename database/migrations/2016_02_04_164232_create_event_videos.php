<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventVideos extends Migration
{
    public function up()
    {
        Schema::create('event_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("event_id")->unsigned();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->string('src');
            $table->tinyInteger("put_in_gallery")->default(0);
        });
    }



    public function down()
    {
        Schema::drop('event_videos');
    }
}
