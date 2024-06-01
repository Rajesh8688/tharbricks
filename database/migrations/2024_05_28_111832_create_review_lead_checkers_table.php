<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewLeadCheckersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_lead_checkers', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->string('email');
            $table->integer('requested_user_id');
            $table->enum('status' , ['notOpended' , 'Opened' , 'Answered'])->default('notOpended');
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
        Schema::dropIfExists('review_lead_checkers');
    }
}
