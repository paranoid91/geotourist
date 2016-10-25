<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdToAllTablesThatDontHaveOne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_trans', function (Blueprint $table) {
            $table->increments('id')->first('tour_id');
        });

        Schema::table('tour_gallery', function (Blueprint $table) {
            $table->increments('id')->first('tour_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_trans', function (Blueprint $table) {
            $table->dropColumn(["id"]);
        });

        Schema::table('tour_gallery', function (Blueprint $table) {
            $table->dropColumn(["id"]);
        });
    }
}
