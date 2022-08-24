<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinutesPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minutes_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->text('description');
            $table->decimal('amount', 10, 5)->default(0.00000);
            $table->unsignedBigInteger('minutes');
            $table->enum('status', ['active', 'inactive'])->default('ACTIVE');
            $table->timestamp('created_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minutes_plan');
    }
}
