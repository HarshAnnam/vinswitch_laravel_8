<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantPaypalAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_paypal_account', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->char('account_code', 10);
            $table->string('paypal_account', 50);
            $table->string('billing_agreement_id', 50);
            $table->string('payer_id', 50);
            $table->text('token');
            $table->enum('status', ['gettoken', 'agreementsuccess', 'success']);
            $table->string('datetime', 50);
            $table->string('correlation_id', 30);
            $table->string('build', 30);
            $table->enum('Isdefault', ['yes', 'no'])->default('NO');
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('account_code', 'tenant_paypal_account_ibfk_1')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_paypal_account');
    }
}
