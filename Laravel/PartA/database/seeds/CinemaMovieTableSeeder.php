<?php

use Illuminate\Database\Seeder;

class CinemaMovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cinema_movie')->delete();

        // Cinema 1
        DB::table('cinema_movie')->insert([
            'movie_id' => '1',
            'cinema_id' => '1',
        ]);
        DB::table('cinema_movie')->insert([
            'movie_id' => '2',
            'cinema_id' => '1',
        ]);
        DB::table('cinema_movie')->insert([
            'movie_id' => '3',
            'cinema_id' => '1',
        ]);
        DB::table('cinema_movie')->insert([
            'movie_id' => '4',
            'cinema_id' => '1',
        ]);

        // Cinema 2
        DB::table('cinema_movie')->insert([
            'movie_id' => '1',
            'cinema_id' => '2',
        ]);
        DB::table('cinema_movie')->insert([
            'movie_id' => '3',
            'cinema_id' => '2',
        ]);
        DB::table('cinema_movie')->insert([
            'movie_id' => '4',
            'cinema_id' => '2',
        ]);

        // Cinema 3
        DB::table('cinema_movie')->insert([
            'movie_id' => '1',
            'cinema_id' => '3',
        ]);
        DB::table('cinema_movie')->insert([
            'movie_id' => '2',
            'cinema_id' => '3',
        ]);
        DB::table('cinema_movie')->insert([
            'movie_id' => '4',
            'cinema_id' => '3',
        ]);

        // Cinema 4
        DB::table('cinema_movie')->insert([
            'movie_id' => '1',
            'cinema_id' => '4',
        ]);
        DB::table('cinema_movie')->insert([
            'movie_id' => '2',
            'cinema_id' => '4',
        ]);
        DB::table('cinema_movie')->insert([
            'movie_id' => '3',
            'cinema_id' => '4',
        ]);
    }
}
