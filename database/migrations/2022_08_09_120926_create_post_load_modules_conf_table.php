<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostLoadModulesConfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_load_modules_conf', function (Blueprint $table) {
            $table->increments('id');
            $table->string('module_name', 64)->unique('unique_mod');
            $table->boolean('load_module')->default(1);
            $table->unsignedInteger('priority')->default(1000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_load_modules_conf');
    }
}
