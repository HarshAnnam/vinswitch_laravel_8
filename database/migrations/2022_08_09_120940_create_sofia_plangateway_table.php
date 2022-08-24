<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSofiaPlangatewayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sofia_plangateway', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('plan_id');
            $table->integer('gateway_id');
            $table->integer('priority');
            
            $table->foreign('plan_id', 'sofia_plangateway_ibfk_1')->references('id')->on('sofia_rateplan');
            $table->foreign('gateway_id', 'sofia_plangateway_ibfk_2')->references('id')->on('gateways');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sofia_plangateway');
    }
}
