<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('gateway_name', 100);
            $table->string('prefix', 100)->nullable();
            $table->string('username', 50);
            $table->string('password', 50);
            $table->string('auth_username', 50);
            $table->string('realm', 100);
            $table->string('from_user', 100);
            $table->string('from_domain', 100);
            $table->string('proxy', 100);
            $table->string('register_proxy', 100);
            $table->string('outbound_proxy', 100);
            $table->string('expire_seconds', 50);
            $table->enum('register', ['true', 'false']);
            $table->string('retry_seconds', 50);
            $table->string('ping', 100);
            $table->string('caller_id_in_from', 100);
            $table->string('channels', 100);
            $table->string('profile', 100)->nullable();
            $table->string('hostname', 100);
            $table->enum('outbound_default', ['yes', 'no'])->default('NO');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gateways');
    }
}
