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
        Schema::create('empanelment_forms', function (Blueprint $table) {
            $table->id();
            $table->string('scope', 500);
            $table->string('channel_partner', 500);
            $table->text('address', 500)->nullable();
            $table->string('phone', 500)->nullable();
            $table->string('telephone', 500)->nullable();
            $table->string('email', 500)->nullable();
            $table->string('rera', 500)->nullable();
            $table->string('contact_person_name', 500)->nullable();
            $table->string('designation', 500)->nullable();
            $table->string('pan', 500)->nullable();
            $table->string('gst', 500)->nullable();
            $table->string('sac', 500)->nullable();
            $table->string('tax', 500)->nullable();
            $table->string('bank_name', 500)->nullable();
            $table->string('bank_address', 500)->nullable();
            $table->string('bank_branch', 500)->nullable();
            $table->string('bank_account_number', 500)->nullable();
            $table->string('ifsc', 500)->nullable();
            $table->string('ip_address', 500)->nullable();
            $table->boolean('msme')->default(0);
            $table->string('msme_image', 500)->nullable();
            $table->boolean('esi')->default(0);
            $table->boolean('epf')->default(0);
            $table->string('pan_image', 500)->nullable();
            $table->string('gst_image', 500)->nullable();
            $table->string('seal_image', 500)->nullable();
            $table->string('cheque_image', 500)->nullable();
            $table->string('rera_image', 500)->nullable();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empanelment_forms');
    }
};
