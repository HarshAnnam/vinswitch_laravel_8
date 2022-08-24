<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('payment_id')->index();
            $table->char('account_number', 10);
            $table->string('type', 30)->comment("Payment_Refund");
            $table->dateTime('date');
            $table->decimal('amount', 20, 5)->default(0.00000);
            $table->decimal('paypal_fees', 20, 5)->nullable();
            $table->decimal('final_amount', 20, 5)->nullable();
            $table->decimal('balance', 20, 5)->default(0.00000);
            $table->decimal('total', 20, 5);
            $table->string('status', 30)->comment("Unapplied,applied, closed");
            $table->string('payment_method', 30)->comment("Check, Cash, Wire, Visa, MasterCard, American Express");
            $table->string('reference_number', 30);
            $table->string('failed_reason', 200)->nullable();
            $table->unsignedInteger('invoice_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('account_number', 'fk1_payment_account_number')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
