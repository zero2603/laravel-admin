<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('restaurent_name');
            $table->string('website');
            $table->string('address');
            $table->string('country');
            $table->string('phone');
            $table->string('tax');
            $table->string('type');
            $table->string('currency');
            $table->boolean('verified')->default(false);
            $table->integer('enable');
            $table->integer('role')->default(0);
            $table->string('note');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
