<?php
namespace Persistence\database\seeds\databaseSeeder;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait Clients
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function clients()
    {
        DB::table('oauth_clients')->insert([
            'id' => '1',
            'user_id' => null,
            'name' => 'Password Grant Client',
            'secret' => 'JQSjqwTfoyS76AeyxBSBFkqTEBOuL9CuZ6cHAKxm',
            'redirect' => 'http://localhost',
            'personal_access_client' => '0',
            'password_client' => '1',
            'revoked' => '0',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('oauth_clients')->insert([
            'id' => '2',
            'user_id' => null,
            'name' => 'User Service Client',
            'secret' => 'oK4cWbukSqCE192ZPQ1fBjSQZbYNhpWzIQyOU0L2',
            'redirect' => 'http://localhost',
            'personal_access_client' => '0',
            'password_client' => '0',
            'revoked' => '0',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

    }
}
