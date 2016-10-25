<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestampsToReviesTables extends Migration
{

    public function up()
    {
        Schema::table('tour_reviews', function (Blueprint $table) {
            $table->string("time_added");
        });

        Schema::table('event_reviews', function (Blueprint $table) {
            $table->string("time_added");
        });
    }


    public function down()
    {
        Schema::table('tour_reviews', function (Blueprint $table) {
            $table->dropColumn("time_added");
        });

        Schema::table('event_reviews', function (Blueprint $table) {
            $table->dropColumn("time_added");
        });
    }
}
