<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentCommissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_commission', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->unsignedInteger('agent_id');
            $table->char('tenant_account_number', 10)->nullable();
            $table->string('summary',500);
            $table->decimal('amount', 10, 5);
            $table->decimal('commission_percentage', 5, 2)->default(0.00);
            $table->decimal('debit', 10, 5)->default(0.00000);
            $table->decimal('credit', 10, 5)->default(0.00000);
            $table->decimal('balance', 10, 5)->default(0.00000);
            $table->unsignedInteger('invoice_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->dateTime('created_date')->useCurrent();
            $table->dateTime('updated_date')->useCurrent();
            $table->foreign('agent_id', 'agent_commission_ibfk_1')->references('id')->on('agent');
            $table->foreign('invoice_id', 'agent_commission_ibfk_2')->references('id')->on('invoice');
            $table->foreign('tenant_account_number', 'agent_commission_ibfk_3')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_commission');
    }
}
