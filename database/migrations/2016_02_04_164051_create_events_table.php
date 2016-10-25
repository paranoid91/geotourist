<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('event_cat')->onDelete('cascade');
            $table->string('paralax_img')->nullable();
            $table->string('list_img')->nullable();
            $table->text('google_map')->nullable();
            $table->string('price')->nullable();
            $table->tinyInteger("upcoming")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
