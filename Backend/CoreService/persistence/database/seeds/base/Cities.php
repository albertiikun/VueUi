<?php

namespace Persistence\database\seeds\base;

use Illuminate\Support\Facades\DB;

trait Cities
{
    public function Cities()
    {
        DB::table('cities')->insert([
            'id' => '3129e2b9-8268-4dd9-9c59-addc1ee300b6',
            'name' => 'Prishtina',
            'zipCode' => '10000',
            'country_id' => '2d6d8422-5dc2-4a87-a969-016050f1f483'
        ]);

        DB::table('cities')->insert([
            'id' => '3129e2b9-8268-4dd8-9c59-addc1ee300b6',
            'name' => 'Podujeva',
            'zipCode' => '11000',
            'country_id' => '2d6d8422-5dc2-4a87-a969-016050f1f483'
        ]);
    }
}
