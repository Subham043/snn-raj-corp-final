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
        Schema::create('campaign_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500);
            $table->string('email');
            $table->string('phone');
            $table->string('ip_address')->nullable();
            $table->string('otp')->nullable();
            $table->boolean('is_verified')->default(0);
            $table->text('page_url');
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_enquiries');
    }
};
