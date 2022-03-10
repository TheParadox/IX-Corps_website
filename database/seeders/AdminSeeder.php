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
            'permissions' => 10,
            'password' => '$2y$10$GemHR1WIY7oMs4opF2EquOeMiL47DLezoucSI1OUMqx/VeCmh8Pmy',

            'discordName' => '',
            'companyToolName' => '',
            'dateJoined' => '1901-01-01',
    
            'regiment_id' => 0,
            'company_id' => 0,
    
            'recruiter_id' => 0,
            'processor_id' => 0,
            
            'awards' => "{\"awards\":[]}",
        ]);

        DB::table('users')->insert([
            'name' => 'Corps',
            'permissions' => 5,
            'password' => '$2y$10$MoN/oLCRiM2Rt..VDa1eGOS81mogQOtfFLDKInOQPgMw30OAK6w8G',

            'discordName' => '',
            'companyToolName' => '',
            'dateJoined' => '1901-01-01',
    
            'regiment_id' => 0,
            'company_id' => 0,
    
            'recruiter_id' => 0,
            'processor_id' => 0,
            
            'awards' => "{\"awards\":[]}",
        ]);

        DB::table('users')->insert([
            'name' => 'Regiment',
            'permissions' => 4,
            'password' => '$2y$10$afI2goi3v1VQcYaI1wxW3et4aRtDzZBtGfCJm2j7iEQCxcDbwAnqu',

            'discordName' => '',
            'companyToolName' => '',
            'dateJoined' => '1901-01-01',
    
            'regiment_id' => 0,
            'company_id' => 0,
    
            'recruiter_id' => 0,
            'processor_id' => 0,
            
            'awards' => "{\"awards\":[]}",
        ]);

        DB::table('users')->insert([
            'name' => 'Company',
            'permissions' => 3,
            'password' => '$2y$10$76/v9StvYY7ZuCQ9W2kNdOImHDd8jMPB3aml4Hsj3Uk3mB3HY/8Qi',

            'discordName' => '',
            'companyToolName' => '',
            'dateJoined' => '1901-01-01',
    
            'regiment_id' => 0,
            'company_id' => 0,
    
            'recruiter_id' => 0,
            'processor_id' => 0,
            
            'awards' => "{\"awards\":[]}",
        ]);

        DB::table('users')->insert([
            'name' => 'SNCO',
            'permissions' => 2,
            'password' => '$2y$10$Tu3bJrlQLzhhN4VAQvjs2O7EPhXuSsZVHfwPIVVGRsn/SCifsuvZe',

            'discordName' => '',
            'companyToolName' => '',
            'dateJoined' => '1901-01-01',
    
            'regiment_id' => 0,
            'company_id' => 0,
    
            'recruiter_id' => 0,
            'processor_id' => 0,
            
            'awards' => "{\"awards\":[]}",
        ]);

        DB::table('users')->insert([
            'name' => 'NCO',
            'permissions' => 1,
            'password' => '$2y$10$ifZdj/pIv.6a1hj0kiPy.e0.ycSattU5vCUg/FE.j.FrIWN5dOme.',

            'discordName' => '',
            'companyToolName' => '',
            'dateJoined' => '1901-01-01',
    
            'regiment_id' => 0,
            'company_id' => 0,
    
            'recruiter_id' => 0,
            'processor_id' => 0,
            
            'awards' => "{\"awards\":[]}",
        ]);

        DB::table('users')->insert([
            'name' => 'Enlisted',
            'permissions' => 0,
            'password' => '$2y$10$fx0ebskP.i42sq6cfW6FgejkaWKWqfs75zzxf3IW7eSBx45kzX1s.',

            'discordName' => '',
            'companyToolName' => '',
            'dateJoined' => '1901-01-01',
    
            'regiment_id' => 0,
            'company_id' => 0,
    
            'recruiter_id' => 0,
            'processor_id' => 0,
            
            'awards' => "{\"awards\":[]}",
        ]);
    }
}
