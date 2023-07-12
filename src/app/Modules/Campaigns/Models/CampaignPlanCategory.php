<?php

namespace App\Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignPlanCategory extends Model
{
    use HasFactory;

    protected $table = 'campaign_plan_category_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'campaign_id',
    ];

    public function Campaign()
    {
        return $this->belongsTo('App\Modules\Campaigns\Models\Campaign', 'campaign_id')->withDefault();
    }

    public function CampaignPlanImage()
    {
        return $this->hasMany('App\Modules\Campaigns\Models\CampaignPlanImage', 'category_id');
    }
}
