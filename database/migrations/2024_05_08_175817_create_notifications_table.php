<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('message');
            $table->integer('user_id')->nullable();
            $table->enum('status', ['Active', 'InActive'])->default('Active');
            $table->tinyInteger('is_delivered')->default(0)->nullable();
            $table->tinyInteger('to_all')->default(0);
            $table->integer('lead_id')->nullable();
            $table->tinyInteger('is_failed')->default(0)->nullable();
            $table->string('failure_reason')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
