<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndPointDidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('end_point_did', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('end_point_id');
            $table->string('number', 15);
            $table->timestamp('created_at')->default('0000-00-00 00:00:00')->useCurrentOnUpdate();
            
            $table->foreign('end_point_id', 'fk_ep_did_id')->references('id')->on('end_point');
            $table->foreign('number', 'fk_epd_number')->references('number')->on('did');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('end_point_did');
    }
}
