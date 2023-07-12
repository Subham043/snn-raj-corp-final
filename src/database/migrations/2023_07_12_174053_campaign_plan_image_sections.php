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
        Schema::create('campaign_plan_image_sections', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->foreignId('category_id')->nullable()->constrained('campaign_plan_category_sections')->nullOnDelete();
            $table->timestamps();
            $table->index(['category_id', 'id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_plan_image_sections');
    }
};
