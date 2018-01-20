<?php

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tickets')->delete();

        DB::table('tickets')->insert([
            'type' => 'adult',
            'amount' => '1',
            'booking_id' => '1',
            'session_id' => '1'
        ]);
        DB::table('tickets')->insert([
            'type' => 'adult',
            'amount' => '1',
            'booking_id' => '1',
            'session_id' => '5'
        ]);
        DB::table('tickets')->insert([
            'type' => 'adult',
            'amount' => '1',
            'booking_id' => '1',
            'session_id' => '10'
        ]);
        DB::table('tickets')->insert([
            'type' => 'adult',
            'amount' => '1',
            'booking_id' => '1',
            'session_id' => '13'
        ]);

        DB::table('tickets')->insert([
            'type' => 'concession',
            'amount' => '2',
            'booking_id' => '2',
            'session_id' => '2'
        ]);

        DB::table('tickets')->insert([
            'type' => 'child',
            'amount' => '3',
            'booking_id' => '3',
            'session_id' => '3'
        ]);

        DB::table('tickets')->insert([
            'type' => 'student',
            'amount' => '4',
            'booking_id' => '4',
            'session_id' => '4'
        ]);
    }
}
