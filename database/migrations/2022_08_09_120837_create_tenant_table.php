<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant', function (Blueprint $table) {
            $table->increments('id');
            $table->char('account_number', 10)->unique('account_number');
            $table->unsignedInteger('agent_id')->nullable();
            $table->unsignedInteger('billpan_id')->nullable();
            $table->date('join_date');
            $table->string('first_name', 60);
            $table->string('last_name', 60);
            $table->string('email', 255);
            $table->string('phone_number', 15);
            $table->decimal('balance', 10, 5)->default(0.00000);
            $table->decimal('unbilled_balance', 10, 5)->default(0.00000);
            $table->decimal('effective_balance', 10, 5)->default(0.00000);
            $table->unsignedBigInteger('monthly_mins')->default(0);
            $table->unsignedBigInteger('additional_mins')->default(0);
            $table->string('company_name', 200);
            $table->string('address', 255);
            $table->string('city', 200);
            $table->string('state', 150);
            $table->string('country', 150);
            $table->string('postal_code', 6);
            $table->enum('status', ['active', 'inactive'])->default('ACTIVE');
            $table->enum('suspended', ['yes', 'no'])->default('NO');
            $table->date('suspend_date')->nullable();
            $table->enum('suspend_reason', ['activation', 'billing', 'manually'])->nullable();
            $table->dateTime('reactivate_date')->nullable();
            $table->dateTime('updated_at')->useCurrent();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('modified_at')->useCurrent();
            
            $table->foreign('billpan_id', 'fk_tenant_billplan')->references('id')->on('bill_plan');
            $table->foreign('agent_id', 'tenant_ibfk_1')->references('id')->on('agent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant');
    }
}
