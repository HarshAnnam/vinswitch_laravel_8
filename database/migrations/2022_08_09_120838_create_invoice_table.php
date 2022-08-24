<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_number', 15);
            $table->string('account_number', 20);
            $table->decimal('previous_balance', 10, 5)->default(0.00000);
            $table->decimal('payment', 10, 5)->default(0.00000);
            $table->decimal('amount', 10, 5);
            $table->decimal('tax_rate', 10, 5)->default(0.00000);
            $table->decimal('tax', 10, 5)->default(0.00000);
            $table->decimal('amount_due', 10, 5)->default(0.00000);
            $table->date('date');
            $table->enum('status', ['new', 'paid', 'overdue', 'voided'])->default('NEW');
            $table->date('due_date');
            $table->text('invoice_file');
            $table->unsignedInteger('payment_id')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('commission_status', ['new', 'generated'])->default('NEW');
            
            $table->foreign('account_number', 'fk_invoice_an')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
