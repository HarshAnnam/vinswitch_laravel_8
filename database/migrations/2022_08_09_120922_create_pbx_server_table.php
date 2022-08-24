<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePbxServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbx_server', function (Blueprint $table) {
            $table->increments('id');
            $table->string('server_name', 50);
            $table->text('server_description');
            $table->string('server_ip', 80);
            $table->string('server_url', 500);
            $table->string('domain_url', 50);
            $table->string('db_username', 100);
            $table->string('db_password', 100);
            $table->integer('db_port');
            $table->string('db_name', 80);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pbx_server');
    }
}
