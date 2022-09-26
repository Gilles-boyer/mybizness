<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScriptMehodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('script_mehods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_method_id');
            $table->foreign('fk_method_id')->references('id')->on('methods')->onDelete('cascade');
            $table->unsignedBigInteger('fk_script_id')->nullable();
            $table->foreign('fk_script_id')->references('id')->on('scripts')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('fk_script_mehods_id')->nullable();
            $table->foreign('fk_script_mehods_id')->references('id')->on('script_mehods')->onDelete('cascade')->nullable();
            $table->integer("order");
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
        Schema::dropIfExists('script_mehods');
    }
}
