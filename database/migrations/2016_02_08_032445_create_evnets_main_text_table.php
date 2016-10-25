<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvnetsMainTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_main_text', function (Blueprint $table) {
            $table->increments('id');
            $table->text("en_main_text")->nullable();
            $table->text("ge_main_text")->nullable();
            $table->text("ru_main_text")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_main_text');
    }
}
