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
        Schema::create('contact_form_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500);
            $table->string('email', 500);
            $table->string('phone', 500)->nullable();
            $table->string('country_code', 500)->nullable();
            $table->string('ip_address', 500)->nullable();
            $table->string('otp', 500)->nullable();
            $table->string('subject', 500)->nullable();
            $table->string('message', 500)->nullable();
            $table->string('page_url', 500)->nullable();
            $table->boolean('is_verified')->default(0);
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_form_enquiries');
    }
};
