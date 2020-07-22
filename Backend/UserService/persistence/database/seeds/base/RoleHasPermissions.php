<?php

namespace Persistence\database\seeds\base;

use Illuminate\Support\Facades\DB;

trait RoleHasPermissions
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function roleHasPermissions()
    {
        DB::table('role_has_permissions')->insert([
            'id' => 'a012436b-6b6a-425c-9417-22734797a8db',
            'role_id' => '17d61eeb-3ed2-4801-b417-6d5943079c6b',
            'permission_id' => 'e7ae158f-8bab-43dc-b7fd-e04a867d8f9d',
        ]);

        DB::table('role_has_permissions')->insert([
            'id' => 'ba25c971-56b5-45ac-98d9-f9c4ade9f50c',
            'role_id' => '17d61eeb-3ed2-4801-b417-6d5943079c6b',
            'permission_id' => 'c34d2f1b-a82f-4684-ba21-fde543652f39',
        ]);

        DB::table('role_has_permissions')->insert([
            'id' => 'cf14b110-e119-4d66-95ea-3e44d517a8fc',
            'role_id' => '17d61eeb-3ed2-4801-b417-6d5943079c6b',
            'permission_id' => '42b4b996-ec1d-4504-8deb-012f840ab485',
        ]);

        DB::table('role_has_permissions')->insert([
            'id' => 'dbf88727-4f70-4b1f-b2e5-b2feeb14b920',
            'role_id' => '17d61eeb-3ed2-4801-b417-6d5943079c6b',
            'permission_id' => 'd8ac8d42-1431-4d41-a304-408575c9f5b9',
        ]);

        DB::table('role_has_permissions')->insert([
            'id' => 'ef9506bf-b3f7-43b1-bde2-0a70d1051d06',
            'role_id' => '17d61eeb-3ed2-4801-b417-6d5943079c6b',
            'permission_id' => '695723ca-a0f9-405d-88cf-1c630c82882e',
        ]);

        DB::table('role_has_permissions')->insert([
            'id' => '2b8a3916-b4b4-4aba-8589-1fc2138b4388',
            'role_id' => '17d61eeb-3ed2-4801-b417-6d5943079c6b',
            'permission_id' => '709ebc3a-6978-42ae-a8b7-1cbee08ae230',
        ]);

        DB::table('role_has_permissions')->insert([
            'id' => '5c519b79-ba68-4738-bfc3-39e79b348fa9',
            'role_id' => '17d61eeb-3ed2-4801-b417-6d5943079c6b',
            'permission_id' => 'ac15a4b7-e9cc-44d0-99f0-4b247c0bf524',
        ]);

        DB::table('role_has_permissions')->insert([
            'id' => '86b69d99-e41e-4807-8048-c1ae8f126c3d',
            'role_id' => '17d61eeb-3ed2-4801-b417-6d5943079c6b',
            'permission_id' => '398472a5-8756-4ac2-8f42-6d9883a18cea',
        ]);
    }
}
