<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeswitchServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freeswitch_server', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('freeswitch_host', 100);
            $table->string('freeswitch_password', 50);
            $table->string('freeswitch_port', 10);
            $table->boolean('status')->default(0)->comment("	0=Active , 1= inactive");
            $table->dateTime('creation_date')->default('1000-01-01 00:00:00')->useCurrentOnUpdate();
            $table->dateTime('last_modified_date')->default('1000-01-01 00:00:00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freeswitch_server');
    }
}
