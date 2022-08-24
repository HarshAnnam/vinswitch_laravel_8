<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSofiaSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sofia_settings', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('sofia_id')->nullable();
            $table->string('param_name', 255)->nullable();
            $table->string('param_value', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sofia_settings');
    }
}
