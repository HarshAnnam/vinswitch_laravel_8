<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAclNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acl_nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cidr', 45);
            $table->string('type', 16);
            $table->unsignedInteger('list_id');
            $table->enum('is_endpoint', ['YES', 'NO'])->default('YES');
            $table->enum('delete', ["0", "1"])->default("0");
            $table->foreign('list_id')->references('id')->on('acl_list');
            $table->dateTime('updated_at')->useCurrent();
            $table->dateTime('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acl_nodes');
    }
}
