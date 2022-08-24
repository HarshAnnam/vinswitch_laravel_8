<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSofiaGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sofia_gateways', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('sofia_id')->nullable();
            $table->string('gateway_name', 255)->nullable();
            $table->string('gateway_param', 255)->nullable();
            $table->string('gateway_value', 255)->nullable();
            $table->integer('gateway_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sofia_gateways');
    }
}
