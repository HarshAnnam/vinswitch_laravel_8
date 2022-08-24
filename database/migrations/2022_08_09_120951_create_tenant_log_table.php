<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_log', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique('id');
            $table->char('account_number', 12);
            $table->text('summary');
            $table->decimal('debit', 10, 5)->default(0.00000);
            $table->decimal('credit', 10, 5)->default(0.00000);
            $table->decimal('balance', 10, 5)->default(0.00000);
            $table->string('referenceno', 20)->nullable();
            $table->dateTime('created_date');
            
            $table->foreign('account_number', 'fk_accn_tenant_log')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_log');
    }
}
