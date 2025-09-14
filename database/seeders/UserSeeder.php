<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'ryan',
            'username' => 'ryan',
            'email' => 'septianhadip2002@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ])->assignRole('kalab');
        
        User::create([
            'name' => 'deo',
            'username' => 'deo',
            'email' => 'septianhadip94@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ])->assignRole('aslab');
    }
}
