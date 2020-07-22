<?php

namespace Persistence\database\seeds\base;

use Illuminate\Support\Facades\DB;

trait Countries
{
    public function Countries()
    {
        DB::table('countries')->insert([
            'id' => '2d6d8422-5dc2-4a87-a969-016050f1f483',
            'name' => 'Kosovo',
        ]);
    }
}
