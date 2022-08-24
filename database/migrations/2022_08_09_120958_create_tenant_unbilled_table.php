<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantUnbilledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_unbilled', function (Blueprint $table) {
            $table->id();
            $table->string('account_number', 20);
            $table->text('description');
            $table->decimal('rate', 10, 5)->default(0.00000);
            $table->integer('quantity')->default(1);
            $table->decimal('amount', 10, 5)->default(0.00000);
            $table->enum('billed', ['yes', 'no'])->default('NO');
            $table->date('from_date');
            $table->date('to_date');
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('account_number', 'tenant_service_unbill')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_unbilled');
    }
}
