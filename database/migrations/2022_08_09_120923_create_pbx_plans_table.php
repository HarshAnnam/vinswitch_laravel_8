<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePbxPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbx_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->char('plan_code', 10);
            $table->string('plan_name', 100);
            $table->text('description');
            $table->enum('status', ['active', 'inactive'])->default('ACTIVE');
            $table->enum('is_trial', ['yes', 'no'])->default('NO');
            $table->decimal('monthly_payment', 10, 5)->default(0.00000);
            $table->integer('no_of_extension');
            $table->decimal('extension_price', 10, 5)->default(0.00000);
            $table->unsignedInteger('pbx_server_id');
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('pbx_server_id', 'pbx_plans_ibfk_1')->references('id')->on('pbx_server');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pbx_plans');
    }
}
