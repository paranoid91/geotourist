<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourGalleryTable extends Migration
{
    public $timestamps = false;

    public function up()
    {
        Schema::create('tour_gallery', function (Blueprint $table) {
            $table->integer('tour_id')->unsigned();
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            $table->string("path");
        });
    }


    public function down()
    {
        Schema::drop('tour_gallery');
    }
}
