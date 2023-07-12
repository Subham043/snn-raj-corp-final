<?php

namespace App\Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CampaignGallery extends Model
{
    use HasFactory;

    protected $table = 'campaign_gallery_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'campaign_id',
    ];

    protected $appends = ['image_link'];

    protected function imageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/campaigns_gallery/'.$this->image),
        );
    }

    public function Campaign()
    {
        return $this->belongsTo('App\Modules\Campaigns\Models\Campaign', 'campaign_id')->withDefault();
    }
}
