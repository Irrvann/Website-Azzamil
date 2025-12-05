<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // kode dibawah ini adalah Deklarasi permission
        $permissions = [
            // User management
            'kelola admin',
            'kelola guru',
            'kelola orang tua',
            'lihat semua users',

            // Role & permission management
            'kelola roles',
            'kelola permissions',
            'lihat roles',

            // Daerah
            'kelola daerah',
            'lihat daerah',

            // Sekolah
            'kelola sekolah',
            'lihat sekolah',

            // Anak
            'kelola anak',
            'lihat anak',
            'lihat anak sendiri',

            // Antropometri
            'tambah antropometri',
            'edit antropometri',
            'hapus antropometri',
            'lihat antropometri',

            // DDST items
            'kelola ddst items',
            'lihat ddst items',

            // DDST Tests
            'buat ddst test',
            'edit ddst test',
            'hapus ddst test',
            'lihat ddst test',

            // DDST Test items
            'isi ddst test item',
            'lihat ddst test item',
        ];

        // kode dibawah ini untuk membuat permission
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // kode dibawah ini untuk deklarasi role
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $guru = Role::firstOrCreate(['name' => 'guru']);
        $ortu = Role::firstOrCreate(['name' => 'orang_tua']);

        // kode dibawah ini untuk assign permission ke role
        $superAdmin->syncPermissions(Permission::all());

        $admin->syncPermissions([
            'kelola guru',
            'kelola orang tua',
            'lihat semua users',

            'lihat daerah',

            'kelola sekolah',
            'lihat sekolah',

            'kelola anak',
            'lihat anak',

            'tambah antropometri',
            'edit antropometri',
            'hapus antropometri',
            'lihat antropometri',

            'kelola ddst items',
            'lihat ddst items',

            'buat ddst test',
            'edit ddst test',
            'hapus ddst test',
            'lihat ddst test',

            'isi ddst test item',
            'lihat ddst test item',
        ]);

        $guru->syncPermissions([
            'kelola anak',
            'lihat anak',

            'tambah antropometri',
            'edit antropometri',
            'hapus antropometri',
            'lihat antropometri',

            'buat ddst test',
            'edit ddst test',
            'lihat ddst test',

            'isi ddst test item',
            'lihat ddst test item',
        ]);

        $ortu->syncPermissions([
            'lihat anak sendiri',
            'lihat antropometri',
            'lihat ddst test',
            'lihat ddst test item',
        ]);
    }
}
