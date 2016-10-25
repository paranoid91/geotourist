<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "saba",
            'email' => "info@geotourist.ge",
            'password' => bcrypt('geotourist111')
        ]);
    }
}
