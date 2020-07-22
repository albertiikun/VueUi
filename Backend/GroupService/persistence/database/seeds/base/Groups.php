<?php

namespace Persistence\database\seeds\base;

use Illuminate\Support\Facades\DB;

trait Groups
{
    public function Groups()
    {
        DB::table('groups')->insert([
            'id' => '1b9920e0-3da7-42a9-89c1-cb59c1ceb287',
            'name' => 'Apple',
            'level' => '2',
            'subject_Id' => '1b9920e0-3da1-42a9-89c1-cb59c1ceb287',
            'studentLimit' => '12',
            'maxLevel' => '6'
        ]);

        DB::table('groups')->insert([
            'id' => 'c634f63a-66de-4e99-881f-132123a05ed4',
            'name' => 'Molla',
            'level' => '4',
            'subject_Id' => '1b9920e0-3da3-42a9-89c1-cb59c1ceb287',
            'studentLimit' => '12',
            'maxLevel' => '8'
        ]);

        DB::table('group_subjects')->insert([
            'id' => '1b9920e0-3da3-42a9-89c1-cb59c1ceb287',
            'name' => 'English',
        ]);

        DB::table('group_subjects')->insert([
            'id' => '1b9920e0-3da1-42a9-89c1-cb59c1ceb287',
            'name' => 'German',
        ]);
    }
}
