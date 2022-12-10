<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_settings', function (Blueprint $table) {
            $table->id();
            $table->string('s_code')->index();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('representative_name')->nullable();
            $table->string('representative_designation')->nullable();
            $table->double('representative_phone')->nullable();
            $table->string('representative_email')->nullable();
            $table->string('is_active')->default(1);
            $table->string('balance')->default(0);
            $table->string('sms_status')->default(0);
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
        Schema::dropIfExists('branch_settings');
    }
}
