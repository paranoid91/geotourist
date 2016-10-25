<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEventCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_cat', function (Blueprint $table) {
            $table->dropColumn(['ge_title', 'en_title', 'ru_title']);
            $table->string("category");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_cat', function (Blueprint $table) {
            $table->string("ge_title");
            $table->string("en_title");
            $table->string("ru_title");
            $table->dropColumn("category");
        });
    }
}
