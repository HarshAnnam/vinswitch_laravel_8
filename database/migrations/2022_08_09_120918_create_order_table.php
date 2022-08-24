<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_no')->unique('order_no');
            $table->dateTime('datetime');
            $table->date('end_date');
            $table->char('tenant_account_no', 10);
            $table->decimal('amount', 10, 5);
            $table->string('type', 50)->comment("DID,SIPACCOUNT,ENDPOINT,E911,SMS,BUY_MINUTES,PBX_PLAN");
            $table->string('status', 30)->comment("CONFIRM,COMPLETED");
            
            $table->foreign('tenant_account_no', 'order_ibfk_1')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
