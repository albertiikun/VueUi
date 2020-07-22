<?php

namespace Persistence\database\seeds\base;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait Factory
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function factory()
    {
        for ($i = 0; $i < 50; $i++) {
            $uuid = (string) Str::uuid();
            $uuid2 = (string) Str::uuid();
            DB::table('users')->insert([
                'id' => $uuid,
                'name' => 'alko' . $i,
                'lastName' => 'kunushevci',
                'phoneNumber' => '+38349312030',
                'birthDate' => '19',
                'city_id' => '3129e2b9-8268-4dd9-9c59-addc1ee300b6',
                'email' => 'alko' . $i . '@gmail.com',
                'userName' => 'alberti' . $i,
                'password' => Hash::make('Asd123123@@'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

            DB::table('user_roles')->insert([
                'id' => $uuid2,
                'user_id' => $uuid,
                'role_id' => '17d61eeb-3ed2-4801-b417-6d5943079c6b',
            ]);
        }
    }
}
