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
        Schema::create('project_additional_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading', 500);
            $table->text('description')->nullable();
            $table->text('description_unfiltered')->nullable();
            $table->string('image', 500)->nullable();
            $table->boolean('is_draft')->default(0);
            $table->boolean('attatch_map')->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_additional_contents');
    }
};

// ALTER TABLE `project_additional_contents` ADD `attatch_map` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_draft`;
