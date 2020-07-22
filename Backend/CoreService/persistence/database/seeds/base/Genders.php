<?php

namespace Persistence\database\seeds\base;

use Illuminate\Support\Facades\DB;

trait Genders
{
    public function Genders()
    {
        DB::table('genders')->insert([
            'id' => '9b4434de-b192-46b8-b3cd-8e9c7bca58d1',
            'name' => 'Male'
        ]);

        DB::table('genders')->insert([
            'id' => 'a37e3977-718b-4c81-b4f5-f62e8dd2bd2f',
            'name' => 'Female'
        ]);
    }
}
