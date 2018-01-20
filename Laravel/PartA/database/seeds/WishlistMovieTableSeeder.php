<?php

use Illuminate\Database\Seeder;

class WishlistMovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wishlist_movie')->delete();

        DB::table('wishlist_movie')->insert([
            'movie_id' => '3',
            'wishlist_id' => '1',
        ]);

        DB::table('wishlist_movie')->insert([
            'movie_id' => '7',
            'wishlist_id' => '1',
        ]);
    }
}
