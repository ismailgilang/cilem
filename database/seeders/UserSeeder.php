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
                'first_name' => 'Vira',
                'last_name'  => 'Nabilah',
                'email'      => 'vira@gmail.com',
                'password'   => Hash::make('1234567'), // Hashing password
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Ariv',
                'last_name'  => 'haliban',
                'email'      => 'ariv@gmail.com',
                'password'   => Hash::make('1234567'),
                'role'       => 'kepala',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
