<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('end_point', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_number', 15);
            $table->string('ip_domain', 50)->index('ip_domain');
            $table->enum('route_type', ['e164', '11digit', '10digit'])->default('10DIGIT');
            $table->enum('status', ['active', 'inactive'])->default('ACTIVE');
            $table->dateTime('created_at');
            $table->timestamp('modified_at')->useCurrent()->useCurrentOnUpdate();
            
            $table->foreign('account_number', 'fk_ep_account_number')->references('account_number')->on('tenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('end_point');
    }
}
