<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->string('template_name');
            $table->string('slug');
            $table->string('template_key');
            $table->enum('module',['user','lead','admin']);
            $table->text('template');
            $table->text('wildcards')->nullable();
            $table->string('email_from_name')->nullable();
            $table->string('email_from')->nullable();
            $table->string('subject');
            $table->integer('user_id')->nullable();
            $table->integer('parent_email_templates_id')->nullable();
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
        Schema::dropIfExists('email_templates');
    }
}
