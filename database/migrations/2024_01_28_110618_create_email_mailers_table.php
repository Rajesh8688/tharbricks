<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailMailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_mailers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('email_template_id')->nullable();;
            $table->unsignedBigInteger('template_user_id')->nullable();
            $table->string('mail_from');
            $table->string('mail_from_name');
            $table->string('mail_to');
            $table->string('mail_to_name');
            $table->enum('reference',['lead','vendor','customer','estimation','userRequest'])->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->text('mail_subject');
            $table->longText('mail_message');
            $table->dateTime('send_date_time')->nullable();
            $table->dateTime('updated_date_time')->nullable();;
            $table->enum('is_cron',[0,1])->default(0);
            $table->enum('cron_status',[0,1,2])->comment('0=>InQueue,1=>success,2=>Failure')->default(0);
            $table->enum('status',['Active','InActive'])->default('Active');
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
        Schema::dropIfExists('email_mailers');
    }
}
