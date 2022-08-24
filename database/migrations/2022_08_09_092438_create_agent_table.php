<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent', function (Blueprint $table) {
            $table->increments('id');
            $table->char('account_code', 10);
            $table->date('join_date');
            $table->string('firstname', 60);
            $table->string('lastname', 60);
            $table->string('email', 255)->unique();
            $table->string('contact_no', 15);
            $table->decimal('balance', 10, 5)->default(0.00000);
            $table->string('company_name', 200);
            $table->string('address', 255);
            $table->string('city', 200);
            $table->string('state', 150);
            $table->string('country', 150);
            $table->string('postal_code', 6);
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->enum('suspended', ['NO', 'YES'])->default('NO');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('modified_at')->nullable();
            $table->dateTime('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent');
    }
}
