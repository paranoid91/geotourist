<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soc_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->unsigned();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("password");
            $table->string("email")->nullable();
            $table->string("avatar")->nullable();
        });
    }


    public function down()
    {
        Schema::drop('soc_users');
    }
}
