<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('internal_lead')->default(0);
            $table->string('email');
            $table->string('phone');
            $table->string('pin_code')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
