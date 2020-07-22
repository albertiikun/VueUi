<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Persistence\database\seeds\base\Base;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_schedules')
            ->insert([
                'id' => '764d3828-8e4a-4ea1-a1a1-f5825782b748',
                'name' => 'One Time',
                'created_at' => Carbon::parse('2020-05-15 03:39:31')
            ]);
        DB::table('payment_schedules')->insert([
            'id' => '5f8db690-681b-472a-9c56-8bcb9d888f67',
            'name' => 'Daily',
            'created_at' => Carbon::parse('2020-05-14 03:39:30')

        ]);
        DB::table('payment_schedules')->insert([
            'id' => 'c42a5b50-0a79-4acf-a74f-3734fd3c8a11',
            'name' => 'Weekly',
            'created_at' => Carbon::parse('2020-05-13 03:39:29')
        ]);
        DB::table('payment_schedules')->insert([
            'id' => '4d572b1e-23fc-468e-b13f-4bfb4b94f0a8',
            'name' => 'Monthly',
            'created_at' => Carbon::parse('2020-05-12 03:39:28')
        ]);
    }
}
