<?php

namespace Persistence\database\seeds\base;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait Roles
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function roles()
    {
        DB::table('roles')->insert([
            'name' => 'Administrator',
            'id' => '17d61eeb-3ed2-4801-b417-6d5943079c6b',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
