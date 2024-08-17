<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('sitename');
            $table->string('web_logo');
            $table->integer('web_status')->default(1);
            $table->string('app_ios_url')->nullable();
            $table->string('app_android_url')->nullable();
            $table->string('app_ios_version')->nullable();
            $table->string('app_android_version')->nullable();
            $table->string('host')->nullable();
            $table->string('port')->nullable();
            $table->string('email')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('from_name')->nullable();
            $table->string('smtp_encryption')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('contact_whatsapp')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('x_url')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->text('google_analytics')->nullable();
            $table->enum('maintenance', ['0', '1'])->default('0');
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
