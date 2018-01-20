<?php

use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->delete();

        DB::table('bookings')->insert([
            'user_id' => '1',
            'name' => 'Joe Smith',
            'address' => '123 Address St',
            'suburb' => 'Suburbia',
            'state' => 'NSW',
            'postcode' => '1234',
            'mobile_number' => '0412345678'
        ]);

        DB::table('bookings')->insert([
            'user_id' => '1',
            'name' => 'Joe Smith',
            'address' => '123 Address St',
            'suburb' => 'Suburbia',
            'state' => 'NSW',
            'postcode' => '1234',
            'mobile_number' => '0412345678'
        ]);

        DB::table('bookings')->insert([
            'user_id' => '1',
            'name' => 'Joe Smith',
            'address' => '123 Address St',
            'suburb' => 'Suburbia',
            'state' => 'NSW',
            'postcode' => '1234',
            'mobile_number' => '0412345678'
        ]);

        DB::table('bookings')->insert([
            'user_id' => '1',
            'name' => 'Joe Smith',
            'address' => '123 Address St',
            'suburb' => 'Suburbia',
            'state' => 'NSW',
            'postcode' => '1234',
            'mobile_number' => '0412345678'
        ]);
    }
}
