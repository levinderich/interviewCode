<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
    }
}
