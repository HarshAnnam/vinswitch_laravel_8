<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCdrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cdr', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('caller_id_name', 100)->default('');
            $table->string('caller_id_number', 255)->default('');
            $table->string('destination_number', 255)->default('');
            $table->string('context', 255)->default('');
            $table->dateTime('start_stamp')->nullable();
            $table->dateTime('answer_stamp')->nullable();
            $table->dateTime('end_stamp')->nullable();
            $table->string('duration', 60)->default('');
            $table->string('billsec', 60)->default('');
            $table->string('charge_sec', 60)->default('0');
            $table->string('hangup_cause', 255)->default('');
            $table->string('uuid', 255)->default('')->unique('uuid');
            $table->string('bleg_uuid', 255)->default('');
            $table->string('accountcode', 20)->nullable();
            $table->string('read_codec', 255)->default('');
            $table->string('write_codec', 255)->default('');
            $table->string('call_direction', 50);
            $table->string('hangup1', 50)->nullable();
            $table->string('routed_to', 100)->nullable();
            $table->string('mos', 50)->nullable();
            $table->string('cname', 50);
            $table->string('forward', 50);
            $table->string('sip_call_id', 250);
            $table->integer('rate_code')->default(0);
            $table->decimal('actual_call_cost', 10, 5)->default(0.00000);
            $table->decimal('call_cost', 10, 5)->nullable();
            $table->decimal('buy_cost', 10, 5)->default(0.00000);
            $table->string('trunk', 50)->nullable();
            $table->string('call_type', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cdr');
    }
}
