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
        Schema::create('campaign_banner_sections', function (Blueprint $table) {
            $table->id();
            $table->text('banner_image');
            $table->string('heading', 500);
            $table->string('sub_heading', 500)->nullable();
            $table->text('points')->nullable();
            $table->foreignId('campaign_id')->nullable()->constrained('campaigns')->nullOnDelete();
            $table->timestamps();
            $table->index(['campaign_id', 'id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_banner_sections');
    }
};
