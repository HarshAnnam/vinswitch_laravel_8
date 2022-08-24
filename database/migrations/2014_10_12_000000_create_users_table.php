<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name',255);
            $table->unsignedInteger('tenant_id')->nullable()->index('tenant_id');
            $table->string('username', 20)->unique('username');
            $table->string('password',128);
            $table->enum('role', ['ADMIN','TENANT','SIPACCOUNT','ENDPOINT'])->default('TENANT');
            $table->string('firstname', 50)->nullable();
            $table->string('lastname', 50)->nullable();
            $table->string('phoneno', 20)->nullable();
            $table->string('email', 255)->nullable()->index('email');
            $table->string('forgotpasswordkey', 128)->nullable();
            $table->timestamp('create_at')->nullable()->useCurrent();
            $table->dateTime('lastvisit_at')->nullable();
            $table->integer('superuser')->default(0);
            $table->enum('status', ['ENABLED', 'DISNABLED'])->default('ENABLED');
            $table->dateTime('updated_at')->useCurrent();
            $table->dateTime('created_at')->useCurrent();    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
