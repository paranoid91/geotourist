<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars_trans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("car_id")->unsigned();
            $table->foreign("car_id")->references('id')->on('cars')->onDelete("cascade");
            $table->integer("lang_id")->unsigned();
            $table->foreign("lang_id")->references('id')->on('langs')->onDelete("cascade");
            $table->string("title")->nullable();
            $table->mediumText("body")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cars_trans');
    }
}
