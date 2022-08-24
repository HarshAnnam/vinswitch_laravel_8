<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_summary', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('order_no');
            $table->string('description', 200);
            $table->decimal('rate', 10, 5)->default(0.00000);
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('order_no', 'order_summary_ibfk_1')->references('order_no')->on('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_summary');
    }
}
