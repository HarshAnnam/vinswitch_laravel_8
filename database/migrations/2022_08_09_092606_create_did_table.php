<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('did', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 20)->unique('number');
            $table->string('account_number', 15)->nullable();
            $table->unsignedBigInteger('order_no')->nullable();
            $table->enum('type', ['DID', 'TOLLFREE', 'PORTIN'])->default('DID');
            $table->string('route_sip_id', 20)->nullable();
            $table->string('did_type', 20)->default('perminute');
            $table->string('rate_center', 50)->nullable();
            $table->enum('status', ['AVAILABLE', 'RESERVED', 'ALLOCATED'])->default('AVAILABLE')->index('status');
            $table->decimal('price', 10, 5)->default(0.00000);
            $table->integer('vendor_id');
            $table->enum('e911', ['ENABLED', 'DISABLED'])->default('DISABLED');
            $table->enum('sms', ['ENABLED', 'DISABLED'])->default('DISABLED');
            $table->dateTime('activated_date')->nullable();
            $table->date('release_date')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            
            $table->foreign('vendor_id', 'did_ibfk_1')->references('id')->on('vendor');
            $table->foreign('account_number', 'fl_did_tenant_accno')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('did');
    }
}
