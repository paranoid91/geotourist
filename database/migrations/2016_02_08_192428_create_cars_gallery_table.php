<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars_gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("car_id")->unsigned();
            $table->foreign("car_id")->references('id')->on('cars')->onDelete("cascade");
            $table->string("path");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cars_gallery');
    }
}
