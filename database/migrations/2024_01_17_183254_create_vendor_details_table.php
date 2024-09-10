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
            $table->text('company_description')->nullable();
            $table->enum('company_size',[1,2,3,4,5])->comment('1=>Self-employed, Sole trader,2=>2-10,3=>11-50,4=>51-200,5=>200+')->nullable();
            $table->string('website')->nullable();
            $table->enum('see_leads_from',['nationwide','custom'])->nullable();
            $table->string('serve_customer_with_in')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('what_do_you_love_most_about_your_job')->nullable();
            $table->string('what_inspired_you_to_start_your_own_business')->nullable();
            $table->string('why_should_our_clients_choose_you')->nullable();
            $table->string('can_you_provide_your_service_online_or_remotely')->nullable();
            $table->string('what_changes_have_made_to_keep_customers_safe_from_covid19')->nullable();
            $table->string('how_long_have_you_been_in_business')->nullable();
            $table->string('what_guarantee_does_your_work_comes_with')->nullable();
            $table->string('whatsapp_number')->nullable();
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
