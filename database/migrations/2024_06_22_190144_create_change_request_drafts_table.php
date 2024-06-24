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
        Schema::create('change_request_drafts', function (Blueprint $table) {
            $table->id();
            $table->string('draft_id');
            $table->string('changerequest');
            $table->string('crd_stage');
            $table->string('status');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
            $table->foreign('draft_id')->references('id')->on('customer_drafts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('change_request_drafts');
    }
};
