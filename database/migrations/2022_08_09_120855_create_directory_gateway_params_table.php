<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectoryGatewayParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directory_gateway_params', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('d_gw_id');
            $table->string('param_name', 64);
            $table->string('param_value', 64);
            
            $table->unique(['d_gw_id', 'param_name'], 'unique_gw_param');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('directory_gateway_params');
    }
}
