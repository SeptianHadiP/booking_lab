<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            // RoleSeeder::class,
            // UsersWithRolesAndPermissionsSeeder::class,
            LaboratoriumSeeder::class,
            MataKuliahPraktikumSeeder::class,
            PertemuanPraktikumSeeder::class,
            KelasSeeder::class,
        ]);

        User::create([
            'name' => 'ryan',
            'username' => 'ryan',
            'email' => 'septianhadip2002@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('kalab');
        
        // User::factory(10)->create();

        // ...existing code...
        // User::factory()->create([
        //     'username' => 'testuser',
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //]);
    }
}
