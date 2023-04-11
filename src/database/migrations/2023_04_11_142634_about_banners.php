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
        Schema::create('about_banners', function (Blueprint $table) {
            $table->id();
            $table->string('heading', 250);
            $table->string('description', 500);
            $table->string('button_text', 250)->nullable();
            $table->string('button_link', 250)->nullable();
            $table->string('image', 500)->nullable();
            $table->string('mission', 500)->nullable();
            $table->string('vission', 500)->nullable();
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
        Schema::dropIfExists('about_banners');
    }
};
