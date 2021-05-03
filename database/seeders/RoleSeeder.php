<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'role_name'=>'Admin',
            'role_description'=>'Bla Bla'
        ]);

        DB::table('role')->insert([
            'role_name'=>'User',
            'role_description'=>'Bla Bla'
        ]);
    }
}