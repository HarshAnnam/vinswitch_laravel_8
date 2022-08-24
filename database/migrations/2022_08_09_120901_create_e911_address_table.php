<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateE911AddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e911_address', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('did', 15);
            $table->char('account_number', 11);
            $table->string('customer_name', 60);
            $table->string('address', 255);
            $table->string('city', 200);
            $table->string('state', 150);
            $table->string('zip', 6);
            $table->string('unit_type', 6);
            $table->string('unit_name', 60);
            $table->string('api_location_id', 20)->nullable();
            
            $table->foreign('account_number', 'e911_address_ibfk_1')->references('account_number')->on('tenant');
            $table->foreign('did', 'fk1_e911_did')->references('number')->on('did');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('e911_address');
    }
}
