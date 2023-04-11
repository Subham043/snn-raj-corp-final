<?php

namespace App\Modules\About\Main\Services;

use App\Http\Services\FileService;
use App\Modules\About\Main\Models\Main;

class MainService
{

    public function getById(Int $id): Main|null
    {
        return Main::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): Main
    {
        return Main::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

    public function saveImage(Main $banner): Main
    {
        $this->deleteImage($banner);
        $image = (new FileService)->save_file('image', (new Main)->image_path);
        $banner->update([
            'image' => $image,
        ]);
        return $banner;
    }

    public function deleteImage(Main $banner): void
    {
        if($banner->image){
            $path = str_replace("storage","app/public",$banner->image);
            (new FileService)->delete_file($path);
        }
    }

}
