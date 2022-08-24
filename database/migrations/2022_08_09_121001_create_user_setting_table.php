<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_setting', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('user_id')->nullable();
            $table->string('address', 255);
            $table->string('city', 200);
            $table->string('state', 200);
            $table->string('country', 200);
            $table->string('zip', 6);
            $table->string('logo', 200);
            $table->string('icon', 200);
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('modified_at')->nullable();
            
            $table->foreign('user_id', 'user_setting_ibfk_1')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_setting');
    }
}
