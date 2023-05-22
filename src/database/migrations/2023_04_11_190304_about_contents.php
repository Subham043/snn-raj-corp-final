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
        Schema::create('about_contents', function (Blueprint $table) {
            $table->id();
            $table->string('heading', 250);
            $table->string('button_text', 250)->nullable();
            $table->string('button_link', 250)->nullable();
            $table->text('description')->nullable();
            $table->text('description_unfiltered')->nullable();
            $table->string('image', 500)->nullable();
            $table->boolean('is_draft')->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('activate_popup')->default(0);
            $table->string('popup_button_text', 250)->nullable();
            $table->text('popup_description')->nullable();
            $table->text('popup_description_unfiltered')->nullable();
            $table->timestamps();
            $table->index(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_contents');
    }
};
