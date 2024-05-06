<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentIdTocreditLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credit_transaction_logs', function (Blueprint $table) {
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razor_pay_paymentinvoice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credit_transaction_logs', function (Blueprint $table) {
            //
        });
    }
}
