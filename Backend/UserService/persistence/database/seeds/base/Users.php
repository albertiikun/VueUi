<?php

namespace Persistence\database\seeds\base;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait Users
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function users()
    {
        DB::table('users')->insert([
            'id' => '1ae45b49-941f-49ad-979b-a2e59f3216d1',
            'name' => 'albert',
            'lastName' => 'kunushevci',
            'phoneNumber' => '+38349312030',
            'birthDate' => '19',
            'city_id' => '3129e2b9-8268-4dd9-9c59-addc1ee300b6',
            'email' => 'admin@gmail.com',
            'userName' => 'apple',
            'password' => Hash::make('Asd123123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'id' => '2ea3d7ed-cb59-4b83-80c9-3880f71b0dac',
            'name' => 'albert',
            'lastName' => 'kunushevci',
            'phoneNumber' => '+38349312030',
            'birthDate' => '19',
            'city_id' => '3129e2b9-8268-4dd9-9c59-addc1ee300b6',
            'email' => 'albertii.kun@gmail.com',
            'userName' => 'alko',
            'password' => Hash::make('Asd123123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'id' => '3a39c9d6-c7de-4b52-9d02-066d59411cc8',
            'name' => 'albert',
            'lastName' => 'kunushevci',
            'phoneNumber' => '+38349312030',
            'birthDate' => '19',
            'city_id' => '3129e2b9-8268-4dd9-9c59-addc1ee300b6',
            'email' => 'albertii.a@gmail.com',
            'userName' => 'alberti',
            'password' => Hash::make('Asd123123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
