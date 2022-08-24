<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowBalanceNotificationLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('low_balance_notification_log', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->char('tenant_account_code', 10);
            $table->date('date');
            $table->integer('count');
            $table->timestamp('send_datetime')->useCurrent();
            
            $table->foreign('tenant_account_code', 'low_balance_notification_log_ibfk_1')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('low_balance_notification_log');
    }
}
