<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthassignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authassignment', function (Blueprint $table) {
            $table->string('itemname', 64);
            $table->string('userid', 64);
            $table->text('bizrule')->nullable();
            $table->text('data')->nullable();
            
            $table->primary(['itemname', 'userid']);
            $table->foreign('itemname', 'AuthAssignment_ibfk_1')->references('name')->on('authitem')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authassignment');
    }
}
