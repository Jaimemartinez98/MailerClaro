<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('profiles')->insert([
            'name' => 'Admin',
        ]);
        DB::table('profiles')->insert([
            'name' => 'User',
        ]);



        DB::table('users')->insert([
            'name' => 'Jaime',
            'phone' => '123123',
            'document_number' => '1231',
            'birth_date' => '2021-07-26',
            'city_code' => 1,
            'profile_id' => 1,
            'email' => 'jaimemartinez0605@gmail.com',
            'password' => '$2y$10$ZS96Q6aXvXmP0sC.qkcxoepNk3iMbelVwPYUTWm6BXFn.c0/rN3jC',
        ]);


        DB::table('countries')->insert([
            'name' => 'Colombia',
            'abbreviation' => 'CO',
        ]);

        DB::table('countries')->insert([
            'name' => 'Panama',
            'abbreviation' => 'PA',
        ]);

        DB::table('provincies')->insert([
            'name' => 'Boyaca',
            'country_abbreviation' => 'CO',
        ]);

        DB::table('provincies')->insert([
            'name' => 'Cundinamarca',
            'country_abbreviation' => 'CO',
        ]);


        DB::table('provincies')->insert([
            'name' => 'Colon',
            'country_abbreviation' => 'PA',
        ]);

        DB::table('provincies')->insert([
            'name' => 'Veraguas',
            'country_abbreviation' => 'PA',
        ]);

        DB::table('cities')->insert([
            'name' => 'Tunja',
            'country_abbreviation' => 'CO',
            'province' => 'Boyaca',
        ]);

        DB::table('cities')->insert([
            'name' => 'Soacha',
            'country_abbreviation' => 'CO',
            'province' => 'Cundinamarca',
        ]);

        DB::table('cities')->insert([
            'name' => 'Colon',
            'country_abbreviation' => 'PA',
            'province' => 'Colon',
        ]);
        DB::table('cities')->insert([
            'name' => 'Santiago',
            'country_abbreviation' => 'PA',
            'province' => 'Veraguas',
        ]);






    }
}
