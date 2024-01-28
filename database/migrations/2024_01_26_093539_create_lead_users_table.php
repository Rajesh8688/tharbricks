<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('response_status' , ['Hired' ,'Pending' ,'Archived'])->default('Hired');
            $table->enum('status' , ['Active' ,'InActive'])->default('Active');
            $table->text('notes')->nullable();
            $table->timestamps();
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('lead_id')->references('id')->on('leads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_users');
    }
}
