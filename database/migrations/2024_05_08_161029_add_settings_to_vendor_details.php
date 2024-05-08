<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingsToVendorDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_details', function (Blueprint $table) {
            $table->tinyInteger('is_new_reviews_on_profile_push_notifications')->default(1)->nullable();
            $table->tinyInteger('is_new_leads_i_receive_push_notifications')->default(1)->nullable();
            $table->tinyInteger('is_customers_sending_me_a_message_push_notifications')->default(1)->nullable();
            $table->tinyInteger('is_new_lead_i_receive_email_notifications')->default(1)->nullable();
            $table->tinyInteger('is_customers_closing_leads_ive_responded_email_notifications')->default(1)->nullable();
            $table->tinyInteger('is_customers_dismissing_my_response_email_notifications')->default(1)->nullable();
            $table->tinyInteger('is_customers_hiring_me_email_notifications')->default(1)->nullable();
            $table->tinyInteger('is_customers_reading_a_message_i_sent_email_notifications')->default(1)->nullable();
            $table->tinyInteger('is_customers_requesting_a_call_form_me_email_notifications')->default(1)->nullable();
            $table->tinyInteger('is_customers_requesting_me_to_contact_them_email_notifications')->default(1)->nullable();
            $table->tinyInteger('is_customers_viewing_my_profile_email_notifications')->default(1)->nullable();
            $table->tinyInteger('is_customers_viewing_my_website_email_notifications')->default(1)->nullable();
            $table->tinyInteger('is_a_summary_of_leads_im_matched_to_each_day_email_notifications')->default(1)->nullable();
            $table->tinyInteger('is_customers_sending_me_a_message_email_notifications')->default(1)->nullable();
            $table->tinyInteger('is_new_reviews_on_my_profile_email_notifications')->default(1)->nullable();
            $table->tinyInteger('is_new_reviews_from_other_sources_email_notifications')->default(1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendorDetails', function (Blueprint $table) {
            //
        });
    }
}
