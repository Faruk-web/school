<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('s_code')->nullable()->index();
            $table->string('branch_id')->nullable()->index();
            $table->string('name');
            $table->string('email')->unique()->index();
            $table->string('phone')->unique();
            $table->string('type')->comment("super_admin, owner, owner_helper, branch_user, teacher, reseller");
            $table->string('address')->nullable();
            $table->string('active')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('is_otp_verified')->default(0);
            $table->string('otp')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('default_session')->nullable();
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
        Schema::dropIfExists('users');
    }
}
