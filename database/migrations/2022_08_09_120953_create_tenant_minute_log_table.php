<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantMinuteLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_minute_log', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->char('account_number', 10);
            $table->timestamp('datetime')->useCurrent();
            $table->enum('type', ['add', 'deduct']);
            $table->unsignedBigInteger('monthly_minutes')->default(0)->comment("store in seconds");
            $table->unsignedBigInteger('additional_minutes')->default(0)->comment("store in seconds");
            $table->string('comment', 200);
            $table->bigInteger('balance_monthly_min')->default(0)->comment("store in seconds");
            $table->bigInteger('balance_additional_min')->default(0)->comment("store in seconds");
            
            $table->foreign('account_number', 'tenant_minute_log_ibfk_1')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_minute_log');
    }
}
