<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_service', function (Blueprint $table) {
            $table->increments('id');
            $table->char('account_number', 10);
            $table->string('referenceno', 50);
            $table->unsignedBigInteger('order_no')->nullable();
            $table->string('name', 50);
            $table->string('description', 255)->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('rate', 10, 5)->default(0.00000);
            $table->enum('type', ['monthly', 'onetime'])->default('MONTHLY');
            $table->enum('is_expire', ['yes', 'no'])->default('NO');
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('account_number', 'tenant_service_an')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_service');
    }
}
