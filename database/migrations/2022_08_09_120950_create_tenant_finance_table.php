<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantFinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_finance', function (Blueprint $table) {
            $table->increments('id');
            $table->char('account_number', 12);
            $table->enum('billplan_method', ['postpaid', 'prepaid'])->default('POSTPAID');
            $table->string('taxation', 12)->nullable();
            $table->decimal('credit_limit', 10, 2)->default(0.00)->comment("''0' -> Unlimited'");
            $table->bigInteger('call_per_seconds')->default(50);
            $table->bigInteger('concurrent_call')->default(0);
            $table->bigInteger('port')->default(0);
            $table->enum('invoice_generate_at', ['monthly', 'bi-weekly', 'weekly']);
            $table->date('invoice_generate_date');
            $table->dateTime('invoice_start_date');
            $table->dateTime('invoice_end_date');
            $table->decimal('late_fee', 5, 2)->default(0.00);
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate();
            
            $table->foreign('account_number', 'fK_tenant_finance')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_finance');
    }
}
