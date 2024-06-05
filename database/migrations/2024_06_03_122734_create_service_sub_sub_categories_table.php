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
        Schema::create('service_sub_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('service_subsub_cat_id');
            $table->string('service_subsub_cat_name');
            $table->string('service_subsub_cat_description')->nullable();
            $table->string('service_subsub_cat_status')->nullable();
            $table->unsignedBigInteger('service_sub_cat_id');
            
            $table->timestamps();
            $table->string('service_subsub_cat_created_by')->nullable();
            $table->string('service_subsub_cat_updated_by')->nullable();

            $table->foreign('service_sub_cat_id')
            ->references('service_sub_cat_id')
            ->on('service_sub_categories')
            ->onDelete('cascade');
            $table->unique(['service_sub_cat_id', 'service_subsub_cat_name'], 'sub_cat_subsub_cat_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_sub_sub_categories');
    }
};
