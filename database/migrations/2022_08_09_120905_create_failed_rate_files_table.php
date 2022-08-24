<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedRateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_rate_files', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('rateplan_id')->nullable();
            $table->string('file_name', 100)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_rate_files');
    }
}
