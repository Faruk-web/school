<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->index();
            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('mail')->nullable();
            $table->string('representative_name')->nullable();
            $table->string('representative_phone')->nullable();
            $table->string('representative_email')->nullable();
            $table->string('principal_name')->nullable();
            $table->string('principal_phone')->nullable();
            $table->string('principal_email')->nullable();
            $table->string('is_active')->default(0);
            $table->string('registration_date')->nullable();
            $table->string('next_renew_date')->nullable();
            $table->string('monthley_fee_amount')->nullable();
            $table->string('balance')->default(0);
            $table->string('sms_status')->default(0);
            $table->string('default_session')->nullable();
            $table->string('default_branch')->nullable();
            $table->string('reseller_id')->nullable();
            $table->string('trial_status')->default('running');
            $table->string('trial_end_date')->nullable();
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
        Schema::dropIfExists('school_settings');
    }
}
