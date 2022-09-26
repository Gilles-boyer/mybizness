<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_app_id');
            $table->foreign('fk_app_id')->references('id')->on('applications')->onDelete('cascade');
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
        Schema::dropIfExists('application_methods');
    }
}
