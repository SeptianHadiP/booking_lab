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
        $this->call(RolePermissionSeeder::class);
        // User::factory(10)->create();

// <<<<<<< Updated upstream
//         User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);
// =======
//         // ...existing code...
//         // $this->call(UsersWithRolesAndPermissionsSeeder::class);
//         // ...existing code...
//         // User::factory()->create([
//         //     'username' => 'testuser',
//         //     'name' => 'Test User',
//         //     'email' => 'test@example.com',
//         //]);
// >>>>>>> Stashed changes
    }
}
