<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginIpAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_ip_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('user_id');
            $table->string('ipAddress');
            $table->string('client_name')->nullable();
            $table->string('client_type')->nullable();
            $table->string('client_version')->nullable();
            $table->string('client_engine')->nullable();
            $table->string('client_engine_version')->nullable();
            $table->string('os_name')->nullable();
            $table->string('os_version')->nullable();
            $table->string('os_platform')->nullable();
            $table->string('iso_code')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_ip_addresses');
    }
}
