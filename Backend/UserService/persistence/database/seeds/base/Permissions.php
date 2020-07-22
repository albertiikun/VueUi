<?php

namespace Persistence\database\seeds\base;

use Illuminate\Support\Facades\DB;

trait Permissions
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function permissions()
    {
        DB::table('permissions')->insert([
            'id' => 'e7ae158f-8bab-43dc-b7fd-e04a867d8f9d',
            'name' => 'get Administrator',
            'roleRefs' => 'Administrator'
        ]);

        DB::table('permissions')->insert([
            'id' => 'c34d2f1b-a82f-4684-ba21-fde543652f39',
            'name' => 'get-deactivated Administrator',
            'roleRefs' => 'Administrator'
        ]);

        DB::table('permissions')->insert([
            'id' => '42b4b996-ec1d-4504-8deb-012f840ab485',
            'name' => 'register Administrator',
            'roleRefs' => 'Administrator'
        ]);

        DB::table('permissions')->insert([
            'id' => 'd8ac8d42-1431-4d41-a304-408575c9f5b9',
            'name' => 'edit-info Administrator',
            'roleRefs' => 'Administrator'
        ]);

        DB::table('permissions')->insert([
            'id' => '695723ca-a0f9-405d-88cf-1c630c82882e',
            'name' => 'edit-password Administrator',
            'roleRefs' => 'Administrator'
        ]);


        DB::table('permissions')->insert([
            'id' => '0c0cdcd4-5876-467a-bd20-529da9a0a54b',
            'name' => 'edit-username-email Administrator',
            'roleRefs' => 'Administrator'
        ]);

        DB::table('permissions')->insert([
            'id' => 'dd835857-6ddc-4c94-8638-fa97a7823bad',
            'name' => 'deactive Administrator',
            'roleRefs' => 'Administrator'
        ]);

        DB::table('permissions')->insert([
            'id' => 'ac15a4b7-e9cc-44d0-99f0-4b247c0bf524',
            'name' => 'active Administrator',
            'roleRefs' => 'Administrator'
        ]);

        DB::table('permissions')->insert([
            'id' => '709ebc3a-6978-42ae-a8b7-1cbee08ae230',
            'name' => 'delete Administrator',
            'roleRefs' => 'Administrator'
        ]);

        DB::table('permissions')->insert([
            'id' => '398472a5-8756-4ac2-8f42-6d9883a18cea',
            'name' => 'manage-roles',
        ]);

        DB::table('permissions')->insert([
            'id' => '4281a81d-4722-4912-b8e5-51783fb91dcc',
            'name' => 'event edit',
        ]);

        DB::table('permissions')->insert([
            'id' => 'deb946e4-7c3d-4d5a-b43a-3636f7f3f89b',
            'name' => 'event create',
        ]);

        DB::table('permissions')->insert([
            'id' => '26f23b5f-b3db-4007-8f01-055912c0d4fc',
            'name' => 'event delete',
        ]);
    }
}
