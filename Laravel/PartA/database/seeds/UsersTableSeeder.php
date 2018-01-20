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
        DB::table('users')->delete();

        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@email.com',
            'password' => bcrypt('password'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
    }
}
