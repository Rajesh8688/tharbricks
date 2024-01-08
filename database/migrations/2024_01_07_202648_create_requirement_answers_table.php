<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirementAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirement_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('requirement_id');
            $table->integer('question_id');
            $table->string('answer');
            $table->string('answer_text',500);
            $table->enum('status' , ['Active' ,'InActive'])->default('Active');
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
        Schema::dropIfExists('requirement_answers');
    }
}
