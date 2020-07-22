<?php
namespace Persistence\database\seeds\base;

use Illuminate\Support\Facades\DB;

trait UserRoles
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function userRoles()
    {

        DB::table('user_roles')->insert([
            'id' => 'ae3f7404-2ebc-4db7-a470-f6ffe519c0b8',
            'user_id' => '1ae45b49-941f-49ad-979b-a2e59f3216d1',
            'role_id' => '17d61eeb-3ed2-4801-b417-6d5943079c6b',
        ]);
    }
}
