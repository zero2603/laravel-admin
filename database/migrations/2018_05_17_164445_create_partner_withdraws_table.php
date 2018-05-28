<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_withdraws', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partner_id')->unique();
            $table->string('method');
            $table->string('account_name');
            $table->string('account_number');
            $table->string('bank');
            $table->string('phone');
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
        Schema::dropIfExists('partner_withdraws');
    }
}
