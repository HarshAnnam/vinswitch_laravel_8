<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_token', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('sipaccount_id');
            $table->string('token', 100);
            $table->string('domain', 50);
            $table->string('device', 50);
            $table->enum('status', ['yes', 'no'])->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_token');
    }
}
