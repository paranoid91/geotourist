<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGalleryActiveColumn extends Migration
{

    public function up()
    {
        Schema::table('tour_gallery', function ($table) {
           $table->tinyInteger("put_in_gallery")->default(0);
        });

        Schema::table('tour_videos', function ($table) {
            $table->tinyInteger("put_in_gallery")->default(0);
        });
    }


    public function down()
    {
        Schema::table('tour_gallery', function ($table) {
            $table->dropColumn('put_in_gallery');
        });

        Schema::table('tour_videos', function ($table) {
            $table->dropColumn('put_in_gallery');
        });
    }
}
