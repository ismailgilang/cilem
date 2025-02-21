<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'admin',
                'last_name'  => 'bank',
                'email'      => 'admin@gmail.com',
                'username' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('1234567'), // Hashing password
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'ersa',
                'last_name'  => 'kaelani',
                'email'      => 'kaelani@gmail.com',
                'username' => 'kaelani',
                'password'   => Hash::make('1234567'),
                'role'       => 'nasabah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
