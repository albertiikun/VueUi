<?php

namespace Persistence\database\seeds\base;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait Events
{
    public function seedEvents()
    {
        DB::table('events')->insert([
            'id' => '4168680a-fbc3-4fe4-b884-40d783395774',
            'name' => 'Pushim',
            'from' => Carbon::now(),
            'to' => Carbon::now()->addMinutes(15),
            'description' => 'Pushim pershkak te festes',
            'color' => '#880E4F',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('events')->insert([
            'id' => '0bfb8a75-b02b-4ee9-a555-abb0726e02aa',
            'name' => 'Fest',
            'from' => Carbon::now(),
            'to' => Carbon::now()->addMinutes(23),
            'description' => 'Fest e kosoves',
            'color' => '#C62828',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
