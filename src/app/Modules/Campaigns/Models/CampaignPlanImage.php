<?php

namespace App\Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CampaignPlanImage extends Model
{
    use HasFactory;

    protected $table = 'campaign_plan_image_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'category_id',
    ];

    protected $appends = ['image_link'];

    protected function imageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/campaigns_plan_image/'.$this->image),
        );
    }

    public function CampaignPlanCategory()
    {
        return $this->belongsTo('App\Modules\Campaigns\Models\CampaignPlanCategory', 'category_id')->withDefault();
    }
}
