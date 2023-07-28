<?php

namespace App\Modules\Csr\Services;

use App\Http\Services\FileService;
use App\Modules\Csr\Models\CsrBanner;
use Illuminate\Support\Facades\Cache;

class CsrBannerService
{

    public function getById(Int $id): CsrBanner|null
    {
        return CsrBanner::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): CsrBanner
    {
        $banner = CsrBanner::updateOrCreate(
            ['id' => 1],
            [...$data]
        );

        $banner->user_id = auth()->user()->id;
        $banner->save();

        return $banner;
    }

    public function saveImage(CsrBanner $banner): CsrBanner
    {
        $this->deleteImage($banner);
        $image = (new FileService)->save_file('image', (new CsrBanner)->image_path);
        $banner->update([
            'image' => $image,
        ]);
        return $banner;
    }

    public function deleteImage(CsrBanner $banner): void
    {
        if($banner->image){
            $path = str_replace("storage","app/public",$banner->image);
            (new FileService)->delete_file($path);
        }
    }

}
