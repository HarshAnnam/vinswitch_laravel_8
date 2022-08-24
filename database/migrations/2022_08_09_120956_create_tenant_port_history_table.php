<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantPortHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_port_history', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('account_number', 15)->nullable()->index('account_number');
            $table->integer('old_port')->nullable();
            $table->integer('new_port')->nullable();
            $table->string('description', 200)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_port_history');
    }
}
