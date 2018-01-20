<?php

use Illuminate\Database\Seeder;

class TicketTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_types')->delete();

        DB::table('ticket_types')->insert([
            'type' => 'adult',
            'price' => '20'
        ]);

        DB::table('ticket_types')->insert([
            'type' => 'child',
            'price' => '10'
        ]);

        DB::table('ticket_types')->insert([
            'type' => 'concession',
            'price' => '15'
        ]);

        DB::table('ticket_types')->insert([
            'type' => 'student',
            'price' => '17.5'
        ]);
    }
}
