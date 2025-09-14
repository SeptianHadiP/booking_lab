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
        // Buat Permission
        $permissions = [
            // User management
            'index.pengguna',
            'buat.pengguna',
            'liat.pengguna',
            'ubah.pengguna',
            'hapus.pengguna',
            'export.pengguna',

            // Scheduling management
            'index.penjadwalan',
            'buat.penjadwalan',
            'liat.penjadwalan',
            'ubah.penjadwalan',
            'hapus.penjadwalan',
            'export.penjadwalan',

            // Documentation management
            'buat.dokumentasi',
            'liat.dokumentasi',
            'ubah.dokumentasi',
            'hapus.dokumentasi',
            'export.dokumentasi',

            // Role management
            'index.peran',
            'buat.peran',
            'liat.peran',
            'ubah.peran',
            'hapus.peran',
            'export.peran',

            //Practice Report management
            'index.laporan-praktek',
            'buat.laporan-praktek',
            'liat.laporan-praktek',
            'ubah.laporan-praktek',
            'hapus.laporan-praktek',
            'export.laporan-praktek',

            //certificate management
            'index.sertifikat',
            'buat.sertifikat',
            'liat.sertifikat',
            'ubah.sertifikat',
            'hapus.sertifikat',
            'export.sertifikat',

            // template management
            'index.templat',
            'buat.templat',
            'liat.templat',
            'ubah.templat',
            'hapus.templat',
            'export.templat',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Role Ketua Lab
        $kalab = Role::firstOrCreate(['name' => 'kalab']);
        $kalab->syncPermissions(Permission::all());

        // Role Asisten Lab
        $aslab = Role::firstOrCreate(['name' => 'aslab']);
        $aslab->syncPermissions([
            // Scheduling management
            'index.penjadwalan',
            'buat.penjadwalan',
            'liat.penjadwalan',
            'ubah.penjadwalan',
            'hapus.penjadwalan',
            'export.penjadwalan',

            // Documentation management
            'buat.dokumentasi',
            'liat.dokumentasi',
            'ubah.dokumentasi',
            'hapus.dokumentasi',
            'export.dokumentasi',

            //certificate management
            'index.sertifikat',
            'buat.sertifikat',
            'liat.sertifikat',
            'ubah.sertifikat',
            'hapus.sertifikat',
            'export.sertifikat',

            // template management
            'index.templat',
            'buat.templat',
            'liat.templat',
            'ubah.templat',
            'hapus.templat',
            'export.templat',
        ]);

        // Role Dosen
        $dosen = Role::firstOrCreate(['name' => 'dosen']);
        $dosen->syncPermissions([
            // Scheduling management
            'index.penjadwalan',
            'buat.penjadwalan',
            'liat.penjadwalan',
            'ubah.penjadwalan',
            'hapus.penjadwalan',
            'export.penjadwalan',

            //Practice Report management
            'index.laporan-praktek',
            'buat.laporan-praktek',
            'liat.laporan-praktek',
            'ubah.laporan-praktek',
            'hapus.laporan-praktek',
            'export.laporan-praktek',
        ]);
    }
}
