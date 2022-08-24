<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique('name');
            $table->text('description')->nullable();
            $table->enum('type', ['POSTPAID', 'PREPAID'])->default('POSTPAID');
            $table->char('currency', 3)->default('USD');
            $table->integer('pulse_rate')->default(60);
            $table->integer('initial_increment')->default(0);
            $table->integer('bill_period')->default(30)->comment("Bill Period in Days");
            $table->decimal('monthly_payment', 10, 2)->default(0.00);
            $table->unsignedBigInteger('monthly_mins')->default(0)->comment("Stored in seconds");
            $table->decimal('sip_account_price', 10, 5)->default(0.00000)->comment("SIP ACCOUNT PRICE per SIP ACCOUNT");
            $table->decimal('end_point_price', 10, 5)->default(0.00000)->comment("END POINT PRICE PER END POINT");
            $table->decimal('did_price', 10, 5)->default(0.00000)->comment("DID PRICE PER DID");
            $table->decimal('inbound_min_rate', 10, 5)->default(0.00000);
            $table->decimal('inbound_sms_price', 10, 5)->default(0.00000);
            $table->decimal('outbound_sms_price', 10, 5)->default(0.00000);
            $table->decimal('cnam_price', 10, 5)->default(0.00000);
            $table->decimal('e911_price', 10, 5)->default(0.00000);
            $table->decimal('per_channel_price', 10, 5)->default(0.00000);
            $table->string('method', 50)->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->dateTime('modified_at')->nullable();
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
        Schema::dropIfExists('bill_plan');
    }
}
