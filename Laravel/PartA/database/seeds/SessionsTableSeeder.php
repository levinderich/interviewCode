<?php

use Illuminate\Database\Seeder;

class SessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sessions')->delete();

        // Cinema 1
        $date = new DateTime();

        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '1',
            'cinema_id' => '1',
        ]);
        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '2',
            'cinema_id' => '1',
        ]);
        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '3',
            'cinema_id' => '1',
        ]);
        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '4',
            'cinema_id' => '1',
        ]);

        // Cinema 2
        $date = new DateTime();

        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '1',
            'cinema_id' => '2',
        ]);
        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '3',
            'cinema_id' => '2',
        ]);
        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '4',
            'cinema_id' => '2',
        ]);

        // Cinema 3
        $date = new DateTime();

        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '1',
            'cinema_id' => '3',
        ]);
        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '2',
            'cinema_id' => '3',
        ]);
        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '4',
            'cinema_id' => '3',
        ]);

        // Cinema 4
        $date = new DateTime();

        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '1',
            'cinema_id' => '4',
        ]);
        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '2',
            'cinema_id' => '4',
        ]);
        DB::table('sessions')->insert([
            'date' => $date->add(new DateInterval('P1D')),
            'movie_id' => '3',
            'cinema_id' => '4',
        ]);
    }
}
