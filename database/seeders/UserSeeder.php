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
            'first_name' => 'moch',
            'last_name' => 'ersa',
            'email' => 'ersa@gmail.com',
            'username' => 'kaelani',
            'password' => Hash::make('1234567'), // Hashing password
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
