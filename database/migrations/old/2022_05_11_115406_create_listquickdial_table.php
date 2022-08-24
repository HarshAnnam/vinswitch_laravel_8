<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListquickdialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listquickdial', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('itemid');
            $table->string('displayname');
            $table->string('uri');
            $table->integer('priority');
            $table->timestamps()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listquickdial');
    }
}
