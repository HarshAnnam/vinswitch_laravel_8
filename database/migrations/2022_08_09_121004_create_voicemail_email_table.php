<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoicemailEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voicemail_email', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('voicemail_id');
            $table->string('param_name', 64);
            $table->string('param_value', 64);
            
            $table->unique(['param_name', 'voicemail_id'], 'unique_profile_param');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voicemail_email');
    }
}
