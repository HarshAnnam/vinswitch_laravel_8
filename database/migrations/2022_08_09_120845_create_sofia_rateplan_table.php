<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSofiaRateplanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sofia_rateplan', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('plan_name', 100);
            $table->integer('cc')->default(0)->comment("concurrent call");
            $table->integer('max_call_length')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('ACTIVE');
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
        Schema::dropIfExists('sofia_rateplan');
    }
}
