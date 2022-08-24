<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_token', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->char('account_code', 10);
            $table->string('token_user', 20);
            $table->text('token');
            $table->text('diescription');
            $table->enum('status', ['active', 'inactive'])->default('ACTIVE');
            
            $table->foreign('account_code', 'fk_1_tenant')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_token');
    }
}
