<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('order_at');
            $table->string('order_total',20);
            $table->unsignedBigInteger('fk_client_id');
            $table->foreign('fk_client_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('fk_beneficiary_id');
            $table->foreign('fk_beneficiary_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('fk_paiement_id');
            $table->foreign('fk_paiement_id')->references('id')->on('paiement_methods')->onDelete('cascade');
            $table->unsignedBigInteger('fk_app_id')->nullable();
            $table->foreign('fk_app_id')->references('id')->on('applications')->onDelete('cascade');
            $table->unsignedBigInteger('fk_staff_id')->nullable();
            $table->foreign('fk_staff_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
