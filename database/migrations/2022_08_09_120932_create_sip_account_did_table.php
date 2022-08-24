<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSipAccountDidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sip_account_did', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sip_account_id');
            $table->string('number', 20);
            $table->string('forward_to', 15);
            $table->enum('forwarding', ['none', 'unregistered', 'both'])->default('None');
            $table->unsignedInteger('forward_call_sec')->default(60);
            $table->enum('did_routing', ['1', '2'])->default('2')->comment("1 = DID@IP 2 = user@IP");
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('sip_account_id', 'fk1_sip_account_did')->references('id')->on('sip_account');
            $table->foreign('number', 'fk2_sip_account_did')->references('number')->on('did');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sip_account_did');
    }
}
