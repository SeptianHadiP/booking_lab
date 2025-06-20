<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersWithRolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        // $permissions = [
        //     'view schedule',
        //     'edit schedule',
        //     'delete schedule',
        //     'manage users',
        // ];
        // foreach ($permissions as $perm) {
        //     Permission::firstOrCreate(['name' => $perm]);
        // }

        // // Create roles and assign permissions
        // $adminRole = Role::firstOrCreate(['name' => 'admin']);
        // $adminRole->givePermissionTo(Permission::all());

        // $userRole = Role::firstOrCreate(['name' => 'user']);
        // $userRole->givePermissionTo(['view schedule']);

        // // Create users and assign roles
        // $admin = User::firstOrCreate(
        //     ['email' => 'admin@example.com'],
        //     [
        //         'name' => 'Admin User',
        //         'username' => 'admin',
        //         'password' => bcrypt('password'),
        //     ]
        // );
        // $admin->assignRole($adminRole);

        // $user = User::firstOrCreate(
        //     ['email' => 'user@example.com'],
        //     [
        //         'name' => 'Regular User',
        //         'username' => 'user',
        //         'password' => bcrypt('password'),
        //     ]
        // );
        // $user->assignRole($userRole);
    }
}