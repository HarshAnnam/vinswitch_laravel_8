<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpWhitelistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_whitelists', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->char('account_code', 10);
            $table->string('ip_domain', 50);
            
            $table->foreign('account_code', 'ip_whitelists_ibfk_1')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ip_whitelists');
    }
}
