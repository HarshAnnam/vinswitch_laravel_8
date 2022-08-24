<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthitemchildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authitemchild', function (Blueprint $table) {
            $table->string('parent', 64);
            $table->string('child', 64);
            
            $table->primary(['parent', 'child']);
            $table->foreign('parent', 'AuthItemChild_ibfk_1')->references('name')->on('authitem')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('child', 'AuthItemChild_ibfk_2')->references('name')->on('authitem')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authitemchild');
    }
}
