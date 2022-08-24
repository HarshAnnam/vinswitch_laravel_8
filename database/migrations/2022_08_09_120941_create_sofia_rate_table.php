<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSofiaRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sofia_rate', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->integer('plan_id');
            $table->string('rate_name', 50)->nullable();
            $table->string('code', 20);
            $table->string('description', 100);
            $table->decimal('buy_rate', 10, 5);
            $table->decimal('sale_rate', 10, 5);
            $table->decimal('sale_percentage', 10, 2)->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('plan_id', 'sofia_rate_ibfk_1')->references('id')->on('sofia_rateplan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sofia_rate');
    }
}
