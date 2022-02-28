<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'Enlisted',
            'level' => 0
        ]);

        DB::table('permissions')->insert([
            'name' => 'NCO',
            'level' => 1
        ]);

        DB::table('permissions')->insert([
            'name' => 'Senior NCO',
            'level' => 2
        ]);

        DB::table('permissions')->insert([
            'name' => 'Company',
            'level' => 3
        ]);

        DB::table('permissions')->insert([
            'name' => 'Regiment',
            'level' => 4
        ]);

        DB::table('permissions')->insert([
            'name' => 'Corps',
            'level' => 5
        ]);

        DB::table('permissions')->insert([
            'name' => 'Admin',
            'level' => 10
        ]);
    }
}
