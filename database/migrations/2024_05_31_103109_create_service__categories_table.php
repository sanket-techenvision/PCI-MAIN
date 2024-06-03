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
        Schema::create('service_categories', function (Blueprint $table) {
            $table->bigIncrements('service_cat_id');
            $table->string('service_cat_name');
            $table->string('service_cat_description')->nullable();
            $table->string('service_cat_status')->nullable();
            $table->timestamps();
            $table->string('cat_created_by')->nullable();
            $table->string('cat_updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service__categories');
    }
};
