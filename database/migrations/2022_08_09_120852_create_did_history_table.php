<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDidHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('did_history', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('did', 20)->index('did');
            $table->enum('type', ['allocated', 'buy', 'disconnect', 'feature']);
            $table->string('discription', 200);
            $table->string('account_number', 15);
            $table->unsignedBigInteger('order_no')->nullable();
            $table->unsignedInteger('vendor_id')->nullable();
            $table->string('vendor_name', 20)->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('account_number', 'did_history_ibfk_2')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('did_history');
    }
}
