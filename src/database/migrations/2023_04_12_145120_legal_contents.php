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
        Schema::create('legal_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading', 250);
            $table->string('page_name', 250);
            $table->string('slug', 250)->unique();
            $table->text('description')->nullable();
            $table->text('description_unfiltered')->nullable();
            $table->boolean('is_draft')->default(0);
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
        Schema::dropIfExists('legal_contents');
    }
};
