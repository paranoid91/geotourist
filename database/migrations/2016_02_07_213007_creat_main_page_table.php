<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatMainPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_page', function (Blueprint $table) {
            $table->increments('id');
            $table->string("en_headline");
            $table->string("ge_headline");
            $table->string("ru_headline");
            $table->string("en_main_text");
            $table->string("ge_main_text");
            $table->string("ru_main_text");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('main_page');
    }
}
