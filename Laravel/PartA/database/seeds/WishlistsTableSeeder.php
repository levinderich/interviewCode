<?php

use Illuminate\Database\Seeder;

class WishlistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wishlists')->delete();

        DB::table('wishlists')->insert([
            'user_id' => '1'
        ]);
    }
}
