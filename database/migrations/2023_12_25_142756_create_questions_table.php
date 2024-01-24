<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_text');
            $table->enum('type' , ['input','imageRadio' , 'normalRadio' , 'date' ,'multiSelect' ,'decisionMaking']);
            $table->integer('show_other_option')->default(0);
            $table->integer('next_question_id')->nullable();
            $table->integer('service_id');
            $table->integer('order');
            $table->enum('status' , ['Active' ,'InActive'])->default('Active');
            $table->string('slug');
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
        Schema::dropIfExists('questions');
    }
}
