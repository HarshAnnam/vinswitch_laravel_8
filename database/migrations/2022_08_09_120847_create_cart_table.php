<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->string('number', 20)->index('number');
            $table->char('tenant_account_number', 11);
            $table->dateTime('datetime');
            $table->enum('did_type', ['did', 'tollfree', 'portin']);
            $table->decimal('price', 10, 5);
            $table->integer('vendor_id');
            $table->enum('status', ['0', '1'])->default('0');
            
            $table->foreign('tenant_account_number', 'cart_ibfk_2')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
