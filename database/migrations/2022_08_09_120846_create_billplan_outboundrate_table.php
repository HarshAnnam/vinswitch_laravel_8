<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillplanOutboundrateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billplan_outboundrate', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('billplan_id');
            $table->integer('rateplan_id');
            
            $table->foreign('rateplan_id', 'billplan_outboundRate_ibfk_1')->references('id')->on('sofia_rateplan');
            $table->foreign('billplan_id', 'billplan_outboundRate_ibfk_2')->references('id')->on('bill_plan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billplan_outboundrate');
    }
}
