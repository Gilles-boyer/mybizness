<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_first_name',50);
            $table->string('user_last_name',50);
            $table->string('user_phone',15)->unique();
            $table->string('user_email',100)->nullable();
            $table->timestamp('user_email_verified_at')->nullable();
            $table->string('user_password')->nullable();
            $table->unsignedBigInteger('fk_role_id');
            $table->foreign('fk_role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    //

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
