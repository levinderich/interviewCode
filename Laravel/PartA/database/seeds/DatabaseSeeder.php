<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        $this->call(CinemasTableSeeder::class);
        $this->call(CinemaMovieTableSeeder::class);
        $this->call(SessionsTableSeeder::class);
        $this->call(BookingsTableSeeder::class);
        $this->call(TicketTypesTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        $this->call(WishlistsTableSeeder::class);
        $this->call(WishlistMovieTableSeeder::class);
    }
}
