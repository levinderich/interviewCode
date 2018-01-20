<?php

use Illuminate\Database\Seeder;

class CinemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cinemas')->delete();

        DB::table('cinemas')->insert([
            'address' => '245 Hay Street, Perth WA 6000',
        ]);

        DB::table('cinemas')->insert([
            'address' => '378 George Street, Sydney NSW 2000',
        ]);

        DB::table('cinemas')->insert([
            'address' => '234 Bourke Street, Melbourne VIC 3000',
        ]);

        DB::table('cinemas')->insert([
            'address' => '465 Main Street, Brisbane WA 4000',
        ]);
    }
}
