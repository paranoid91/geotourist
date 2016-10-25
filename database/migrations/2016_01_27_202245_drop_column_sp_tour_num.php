<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnSpTourNum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_trans', function (Blueprint $table) {
            $table->dropColumn('sp_tour_num');
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
            $table->integer('sp_tour_num');
        });
    }
}
