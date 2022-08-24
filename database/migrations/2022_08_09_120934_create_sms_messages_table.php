<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start_stamp')->useCurrent();
            $table->unsignedInteger('tenant_id')->nullable();
            $table->unsignedInteger('sip_account_id')->nullable()->index('sip_account_id');
            $table->unsignedInteger('end_point_id')->nullable()->index('end_point_id');
            $table->string('from_number', 20);
            $table->string('to_number', 20);
            $table->text('message');
            $table->string('direction', 10);
            $table->text('response');
            $table->string('sms_guid', 500)->nullable();
            $table->string('carrior', 50);
            $table->decimal('sms_cost', 10, 5)->default(0.00000);
            $table->integer('sms_length');
            
            $table->foreign('tenant_id', 'fk1_tenant_id')->references('id')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_messages');
    }
}
