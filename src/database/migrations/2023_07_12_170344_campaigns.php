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
            $table->integer('campaign_status')->default(CampaignStatusEnum::UPCOMING->label());
            $table->integer('publish_status')->default(PublishStatusEnum::ACTIVE->label());
            $table->text('table_heading')->default('Double Height Ceilings & <span>18 Feet Tall Windows</span>');
            $table->text('gallery_heading')->default('Image <span>Gallery</span>');
            $table->text('specification_heading')->default('Villas With Design Influences From <span>10+ Countries</span>');
            $table->text('plan_heading')->default('Master & <span>Unit Plans</span>');
            $table->text('location_heading')->default('Prime <span>Location</span>');
            $table->text('connectivity_heading')->default('Connectivity <span>At Its Best</span>');
            $table->text('amenities_heading')->default('20+ Worldclass <span>Amenities</span>');
            $table->text('table_main_heading')->default('Raj Viviente by SNN Raj Corp <bt/>Luxury 4BHK Villas Off Bannerghatta Rd');
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
