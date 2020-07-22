<?php

use Illuminate\Database\Seeder;
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
        new Base;
    }
}
