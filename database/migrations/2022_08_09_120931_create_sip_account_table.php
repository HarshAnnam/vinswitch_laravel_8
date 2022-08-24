<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSipAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_number', 15);
            $table->string('username', 15)->unique('username');
            $table->string('password', 15);
            $table->string('sip_name', 50)->nullable();
            $table->string('outbound_caller_number', 50)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('number', 20)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('ACTIVE')->index('status');
            $table->dateTime('created_at');
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate();
            
            $table->foreign('number', 'fk_sip_account_did_number')->references('number')->on('did');
            $table->foreign('account_number', 'fk_sip_account_number')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sip_account');
    }
}
