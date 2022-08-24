<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNpaNxxMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('npa_nxx_master', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name', 60);
            $table->enum('isdefault', ['yes', 'no'])->default('NO');
            $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('modified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('npa_nxx_master');
    }
}
