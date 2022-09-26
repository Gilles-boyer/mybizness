<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_role_id');
            $table->foreign('fk_role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->unsignedBigInteger('fk_method_id');
            $table->foreign('fk_method_id')->references('id')->on('methods')->onDelete('cascade');
            $table->boolean("activate")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_methods');
    }
}
