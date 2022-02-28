<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'permissions' => 7,
            'password' => '$2y$10$GemHR1WIY7oMs4opF2EquOeMiL47DLezoucSI1OUMqx/VeCmh8Pmy',

            'discordName' => '',
            'companyToolName' => '',
            'dateJoined' => '1901-01-01',
    
            'regiment_id' => 0,
            'company_id' => 0,
    
            'recruiter_id' => 0,
            'processor_id' => 0,
        ]);
    }
}
