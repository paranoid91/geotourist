<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarCatTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_cat_trans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("car_cat_id")->unsigned();
            $table->foreign("car_cat_id")->references('id')->on('car_cat')->onDelete("cascade");
            $table->integer("lang_id")->unsigned();
            $table->foreign("lang_id")->references('id')->on('langs')->onDelete("cascade");
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
        Schema::drop('car_cat_trans');
    }
}
