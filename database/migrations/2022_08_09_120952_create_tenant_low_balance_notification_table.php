<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantLowBalanceNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_low_balance_notification', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->char('tenant_account_code', 10);
            $table->enum('Isnotification', ['yes', 'no'])->default('YES');
            $table->integer('notification_threshold')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('modified_at')->nullable();
            
            $table->foreign('tenant_account_code', 'tenant_low_balance_notification_ibfk_1')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_low_balance_notification');
    }
}
