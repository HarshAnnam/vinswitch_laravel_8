<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_setting', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('vendor_id');
            $table->string('setting_key', 200);
            $table->text('setting_value');
            
            $table->foreign('vendor_id', 'vendor_setting_ibfk_1')->references('id')->on('vendor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_setting');
    }
}
