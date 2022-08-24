<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentCommissionPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_commission_payment', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->unsignedInteger('agent_id');
            $table->enum('type', ['payment', 'refund'])->default('PAYMENT');
            $table->decimal('amount', 10, 5);
            $table->enum('payment_method', ['cheque', 'cash', 'wire', 'visa', 'mastercard', 'american express']);
            $table->date('payment_date');
            $table->string('reference_number', 50);
            $table->timestamp('created_date')->useCurrent();
            
            $table->foreign('agent_id', 'agent_commission_payment_ibfk_1')->references('id')->on('agent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_commission_payment');
    }
}
