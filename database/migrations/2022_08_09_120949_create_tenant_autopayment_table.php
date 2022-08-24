<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantAutopaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_autopayment', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->char('tenant_account_code', 10);
            $table->enum('Isautopayment', ['yes', 'no']);
            $table->integer('lowbalance_threshold');
            $table->integer('payment_threshold');
            
            $table->foreign('tenant_account_code', 'tenant_autopayment_ibfk_1')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_autopayment');
    }
}
