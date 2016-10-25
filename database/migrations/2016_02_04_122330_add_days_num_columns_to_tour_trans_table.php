<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDaysNumColumnsToTourTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_trans', function (Blueprint $table) {
            $table->integer("d3_num")->nullable()->unsigned();
            $table->integer("d7_num")->nullable()->unsigned();
            $table->integer("d10_num")->nullable()->unsigned();
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
            $table->dropColumn(['d3_num', 'd7_num', 'd10_num']);
        });
    }
}
