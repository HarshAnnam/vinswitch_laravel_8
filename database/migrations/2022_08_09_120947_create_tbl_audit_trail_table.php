<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAuditTrailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_audit_trail', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->string('action', 255);
            $table->string('model', 255)->index('idx_audit_trail_model');
            $table->string('field', 255)->index('idx_audit_trail_field');
            $table->dateTime('stamp');
            $table->string('user_id', 255)->nullable()->index('idx_audit_trail_user_id');
            $table->string('model_id', 255)->index('idx_audit_trail_model_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_audit_trail');
    }
}
