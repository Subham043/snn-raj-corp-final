<?php

namespace App\Modules\Csr\Services;

use App\Http\Services\FileService;
use App\Modules\Csr\Models\CsrBanner;

class CsrBannerService
{

    public function getById(Int $id): CsrBanner|null
    {
        return CsrBanner::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): CsrBanner
    {
        return CsrBanner::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
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