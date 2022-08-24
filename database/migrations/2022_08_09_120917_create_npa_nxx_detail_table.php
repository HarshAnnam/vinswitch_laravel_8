<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNpaNxxDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('npa_nxx_detail', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('npanxx_id');
            $table->string('state', 20)->nullable();
            $table->string('npanxx', 20)->nullable();
            $table->string('lata', 20)->nullable();
            $table->string('zipcode', 20)->nullable();
            $table->string('zipcode_count', 20)->nullable();
            $table->string('zipcode_freq', 20)->nullable();
            $table->string('npa', 20)->nullable();
            $table->string('nxx', 20)->nullable();
            $table->string('flags', 20)->nullable();
            
            $table->foreign('npanxx_id', 'npa_nxx_detail_ibfk_1')->references('id')->on('npa_nxx_master')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('npa_nxx_detail');
    }
}
