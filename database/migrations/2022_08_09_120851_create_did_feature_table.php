<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDidFeatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('did_feature', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('did', 20);
            $table->enum('feature', ['sms', 'e911']);
            $table->string('account_number', 15);
            $table->timestamp('activated_at')->useCurrent();
            
            $table->foreign('did', 'did_feature_ibfk_1')->references('number')->on('did');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('did_feature');
    }
}
