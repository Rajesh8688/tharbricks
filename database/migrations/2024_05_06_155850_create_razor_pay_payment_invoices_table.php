<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRazorPayPaymentInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razor_pay_payment_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('razorpay_payment_id');
            $table->string('amount')->nullable();
            $table->string('razorpay_status')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('method')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->text('info')->nullable();
            $table->text('acquirer_data')->nullable();
            $table->text('upi')->nullable();
            $table->text('card_id')->nullable();
            $table->enum('status', ['Active', 'InActive'])->default('InActive');
            $table->string('error_code')->nullable();
            $table->string('error_description')->nullable();
            $table->string('error_source')->nullable();
            $table->string('error_step')->nullable();
            $table->string('error_reason')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('razor_pay_payment_invoices');
    }
}
