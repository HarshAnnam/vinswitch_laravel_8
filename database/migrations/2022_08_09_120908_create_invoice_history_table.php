<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_history', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id')->index('invoice_id');
            $table->text('description');
            $table->decimal('rate', 10, 5)->default(0.00000);
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('amount', 10, 5)->default(0.00000);
            $table->date('from_date');
            $table->date('to_date');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_history');
    }
}
