<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_first_name');
            $table->string('user_last_name');
            $table->string('user_mobile')->unique();
            $table->string('user_email')->unique();
            $table->timestamp('user_email_verified_at')->nullable();
            $table->string('password');
            $table->string('user_city');
            $table->string('user_state');
            $table->string('user_country');
            $table->string('user_role')->nullable();
            $table->string('user_status')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('user_created_by')->nullable();
            $table->string('user_updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
