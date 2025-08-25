<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Permission
        $permissions = [
            // User management
            'create user',
            'read user',
            'edit user',
            'distroy user',

            // Scheduling management
            'create scheduling',
            'read scheduling',
            'edit scheduling',
            'distroy scheduling',

            // Documentation management
            'create documentation',
            'read documentation',
            'edit documentation',
            'distroy documentation',

            //roles management
            'create role',
            'read role',
            'edit role',
            'distroy role',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Super Admin: dapat semua permission
        $kalab = Role::firstOrCreate(['name' => 'kalab']);
        $kalab->syncPermissions(Permission::all());

        // Admin: hanya bisa kelola user
        $dosen = Role::firstOrCreate(['name' => 'dosen']);
        $dosen->syncPermissions([
            'create scheduling',
            'read scheduling',
            'edit scheduling',
            'distroy scheduling',
        ]);

        // Aslab/Dosen/others: hanya view
        $aslab = Role::firstOrCreate(['name' => 'aslab']);
        $aslab->syncPermissions([
            'create documentation',
            'read documentation',
            'edit documentation',
            'distroy documentation',
        ]);
    }
}
