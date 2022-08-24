<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSofiaDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sofia_domains', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('sofia_id')->nullable();
            $table->string('domain_name', 255)->nullable();
            $table->tinyInteger('parse')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sofia_domains');
    }
}
