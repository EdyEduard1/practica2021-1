<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
	        'name' => 'Eduard',
	        'email' => 'Eduard@gmail.com',
	        'password' => Hash::make('parola'),
        ]);

        User::create([
	        'name' => 'Edy',
	        'email' => 'Edy@gmail.com',
	        'password' => Hash::make('parola'),
        ]);
    }
}