<?php

namespace App\Modules\About\Banner\Services;

use App\Http\Services\FileService;
use App\Modules\About\Banner\Models\Banner;
use Illuminate\Support\Facades\Cache;

class BannerService
{

    public function getById(Int $id): Banner|null
    {
        return Cache::remember('about_page_banner_main_'.$id, 60*60*12, function() use($id){
            return Banner::where('id', $id)->first();
        });
    }

    public function createOrUpdate(array $data): Banner
    {
        return Banner::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

    public function saveImage(Banner $banner): Banner
    {
        $this->deleteImage($banner);
        $image = (new FileService)->save_file('image', (new Banner)->image_path);
        $banner->update([
            'image' => $image,
        ]);
        return $banner;
    }

    public function deleteImage(Banner $banner): void
    {
        if($banner->image){
            $path = str_replace("storage","app/public",$banner->image);
            (new FileService)->delete_file($path);
        }
    }

}
