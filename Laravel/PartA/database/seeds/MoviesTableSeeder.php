<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->delete();

        DB::table('movies')->insert([
            'title' => 'Dunkirk',
            'poster' => 'img/dunkirk.jpeg',
            'status' => 'Now Showing',
            'featured' => 'true',
        ]);

        DB::table('movies')->insert([
            'title' => 'Deadpool 2',
            'poster' => 'img/deadpool.jpg',
            'status' => 'Now Showing',
            'featured' => 'true',
        ]);

        DB::table('movies')->insert([
            'title' => 'Bill and Ted\'s Excellent Adventure',
            'poster' => 'img/billandted.jpg',
            'status' => 'Now Showing',
            'featured' => 'true',
        ]);

        DB::table('movies')->insert([
            'title' => 'Back to the future',
            'poster' => 'img/backToTheFuture.jpg',
            'status' => 'Now Showing',
            'featured' => 'true',
        ]);

        DB::table('movies')->insert([
            'title' => 'War of the Planet of the Apes',
            'poster' => 'img/planetOfTheApes.jpg',
            'status' => 'Coming Soon',
            'featured' => 'true',
        ]);

        DB::table('movies')->insert([
            'title' => 'Robocop',
            'poster' => 'img/robocop.jpg',
            'status' => 'Coming Soon',
            'featured' => 'false',
        ]);

        DB::table('movies')->insert([
            'title' => 'Star Wars',
            'poster' => 'img/starWars.jpg',
            'status' => 'Coming Soon',
            'featured' => 'false',
        ]);
    }
}
