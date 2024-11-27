<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',

           'member-list',
           'member-create',
           'member-edit',
           'member-delete',

           'setting-list',
           'setting-edit',

           'kategori-list',
           'kategori-create',
           'kategori-edit',
           'kategori-delete',

           'wisata-list',
           'wisata-create',
           'wisata-edit',
           'wisata-delete',

           'kabupaten-list',
           'kabupaten-create',
           'kabupaten-edit',
           'kabupaten-delete',

           'kecamatan-list',
           'kecamatan-create',
           'kecamatan-edit',
           'kecamatan-delete',

           'kelurahan-list',
           'kelurahan-create',
           'kelurahan-edit',
           'kelurahan-delete',

           'permintaan-wisata-list',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
