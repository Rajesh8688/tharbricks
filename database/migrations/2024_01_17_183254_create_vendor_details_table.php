<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('company_name')->nullable();
            $table->string('logo')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('company_description')->nullable();
            $table->enum('company_size',[1,2,3,4,5])->comment('1=>Self-employed, Sole trader,2=>2-10,3=>11-50,4=>51-200,5=>200+')->nullable();
            $table->string('website')->nullable();
            $table->enum('see_leads_from',['nationwide','custom'])->nullable();
            $table->string('serve_customer_with_in')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
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
        Schema::dropIfExists('vendor_details');
    }
}
