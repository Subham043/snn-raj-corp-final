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
        Schema::create('general_theme_settings', function (Blueprint $table) {
            $table->id();
            $table->string('background_color', 500)->nullable();
            $table->string('primary_color', 500)->nullable();
            $table->string('overlay_color', 500)->nullable();
            $table->string('lines_color', 500)->nullable();
            $table->string('text_color', 500)->nullable();
            $table->string('highlight_text_color', 500)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_theme_settings');
    }
};
