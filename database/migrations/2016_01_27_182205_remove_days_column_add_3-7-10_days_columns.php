<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveDaysColumnAdd3710DaysColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_trans', function (Blueprint $table) {
            $table->dropColumn('days');
        });

        Schema::table('tour_trans', function (Blueprint $table) {
            $table->mediumText("d3")->nullable();
            $table->mediumText("d7")->nullable();
            $table->mediumText("d10")->nullable();
            $table->tinyInteger("sp_tour_num")->nullable();
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
            $table->mediumText('days');
        });

        Schema::table('tour_trans', function (Blueprint $table) {
            $table->dropColumn("d3");
            $table->dropColumn("d7");
            $table->dropColumn("d10");
            $table->dropColumn("sp_tour_num");
        });
    }
}
