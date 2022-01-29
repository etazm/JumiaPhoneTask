<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('countries')->truncate();
        \DB::table('countries')->insert([
            [
                'code' => '+237',
                'name' => 'Cameroon',
                'regex' => '\(237\)\ ?[2368]\d{7,8}$',
            ],
            [
                'code' => '+251',
                'name' => 'Ethiopia',
                'regex' => '\(251\)\ ?[1-59]\d{8}$',
            ],
            [
                'code' => '+212',
                'name' => 'Morocco',
                'regex' => '\(212\)\ ?[5-9]\d{8}$',
            ],
            [
                'code' => '+258',
                'name' => 'Mozambique',
                'regex' => '\(258\)\ ?[28]\d{7,8}$',
            ],
            [
                'code' => '+256',
                'name' => 'Uganda',
                'regex' => '\(256\)\ ?\d{9}$',
            ],
        ]);
    }
}
