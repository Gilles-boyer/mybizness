<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->uuid('voucher_num');
            $table->date('voucher_validity');
            $table->string('voucher_message',170);
            $table->string('voucher_color',50);
            $table->string('voucher_font',50);
            $table->unsignedBigInteger('fk_order_id');
            $table->foreign('fk_order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('fk_theme_id');
            $table->foreign('fk_theme_id')->references('id')->on('themes')->onDelete('cascade');
            $table->unsignedBigInteger('fk_shipping_id');
            $table->foreign('fk_shipping_id')->references('id')->on('shipping_methods')->onDelete('cascade');
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
        Schema::dropIfExists('vouchers');
    }
}
