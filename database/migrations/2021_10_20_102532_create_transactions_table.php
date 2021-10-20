<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("reference",50)->unique();
            $table->string("payment_gateway");
            $table->double("total_amount");
            $table->double("gateway_charges");
            $table->string("status");
            $table->string("paid_on")->nullable();
            $table->double("actual_gateway_charges")->nullable();
            $table->double("actual_amount_paid")->nullable();
            $table->string("currency");
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
        Schema::dropIfExists('transactions');
    }
}
