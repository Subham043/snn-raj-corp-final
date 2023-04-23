<?php

use App\Enums\ProjectStatusEnum;
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500);
            $table->string('slug', 500)->unique();
            $table->string('location', 500)->nullable();
            $table->string('floor', 500)->nullable();
            $table->string('acre', 500)->nullable();
            $table->string('tower', 500)->nullable();
            $table->string('rera', 500)->nullable();
            $table->string('brief_description', 500)->nullable();
            $table->text('description')->nullable();
            $table->text('description_unfiltered')->nullable();
            $table->string('address', 500)->nullable();
            $table->string('map_location_link', 500)->nullable();
            $table->string('brochure', 500)->nullable();
            $table->boolean('is_draft')->default(0);
            $table->boolean('is_completed')->default(0);
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_header_script')->nullable();
            $table->text('meta_footer_script')->nullable();
            $table->text('meta_header_no_script')->nullable();
            $table->text('meta_footer_no_script')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
