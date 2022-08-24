<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantPbxPlanLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_pbx_plan_log', function (Blueprint $table) {
            $table->increments('id');
            $table->char('tenant_account_code', 10);
            $table->unsignedInteger('pbx_plan_id');
            $table->string('domain_name', 100)->unique('domain_name');
            $table->text('description');
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('company_name', 50);
            $table->string('email', 50);
            $table->string('username', 50);
            $table->string('password', 50);
            $table->string('salt', 100);
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('updated_at');
            
            $table->foreign('tenant_account_code', 'tenant_pbx_plan_log_ibfk_1')->references('account_number')->on('tenant');
            $table->foreign('pbx_plan_id', 'tenant_pbx_plan_log_ibfk_2')->references('id')->on('pbx_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_pbx_plan_log');
    }
}
