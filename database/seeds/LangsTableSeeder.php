<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(['ge', 'en', 'ru'] as $lang)
        {
            \App\Langs::create([
                'lang' => $lang
            ]);
        }

    }
}