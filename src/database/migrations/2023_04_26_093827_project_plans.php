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
        Schema::create('project_plans', function (Blueprint $table) {
            $table->id();
            $table->string('image_title', 500)->nullable();
            $table->string('image_alt', 500)->nullable();
            $table->string('image', 500)->nullable();
            $table->boolean('is_draft')->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('plan_category_id')->nullable()->constrained('plan_categories')->nullOnDelete();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_plans');
    }
};
