<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsConfigureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_configure', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->char('account_code', 10);
            $table->string('sms_url', 200);
            
            $table->foreign('account_code', 'sms_configure_ibfk_1')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_configure');
    }
}
