<?php

use App\Enums\CampaignStatusEnum;
use App\Enums\PublishStatusEnum;
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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug', 250)->unique();
            $table->text('header_logo');
            $table->text('footer_logo');
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('og_locale')->nullable();
            $table->text('og_type')->nullable();
            $table->text('og_description')->nullable();
            $table->text('og_site_name')->nullable();
            $table->text('og_image')->nullable();
            $table->text('meta_header')->nullable();
            $table->text('meta_footer')->nullable();
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('youtube')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('srd')->nullable();
            $table->text('projectId')->nullable();
            $table->text('brochure_bg_image')->nullable();
            $table->string('country_code', 500)->nullable();
            $table->integer('campaign_status')->default(CampaignStatusEnum::UPCOMING->label());
            $table->integer('publish_status')->default(PublishStatusEnum::ACTIVE->label());
            $table->text('table_heading');
            $table->text('gallery_heading');
            $table->text('specification_heading');
            $table->text('plan_heading');
            $table->text('location_heading');
            $table->text('connectivity_heading');
            $table->text('amenities_heading');
            $table->text('table_main_heading');
            $table->timestamps();
            $table->index(['slug', 'id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};