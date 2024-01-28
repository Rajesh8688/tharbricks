<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditTransactionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_transaction_logs', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->comment('unique id forevery transation')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->integer('credits');
            $table->integer('remaining_credits')->nullable();
            $table->string('credits_desctiption')->nullable();
            $table->enum('action',['added','subtracted'])->default('added');
            $table->enum('status',['Active','InActive'])->default('Active');
            $table->dateTime('date_of_transaction')->nullable();
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
        Schema::dropIfExists('credit_transaction_logs');
    }
}
