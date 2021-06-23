<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->float('amount', 10, 2);
            $table->string('currency')->default('KD');
            $table->string('payment_status')->default('In Progress');
            $table->string('invoice_id');
            $table->string('gateway_payment_id'); 
            $table->string('transaction_id')->nullable();
            $table->string('track_id')->nullable();
            $table->string('shipping_id')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
