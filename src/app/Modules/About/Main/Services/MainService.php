<?php

namespace App\Modules\About\Main\Services;

use App\Http\Services\FileService;
use App\Modules\About\Main\Models\Main;
use Illuminate\Support\Facades\Cache;

class MainService
{

    public function getById(Int $id): Main|null
    {
        return Main::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): Main
    {
        $main = Main::updateOrCreate(
            ['id' => 1],
            [...$data]
        );

        $main->user_id = auth()->user()->id;
        $main->save();

        return $main;
    }

    public function saveImage(Main $main): Main
    {
        $this->deleteImage($main);
        $image = (new FileService)->save_file('image', (new Main)->image_path);
        $main->update([
            'image' => $image,
        ]);
        return $main;
    }

    public function deleteImage(Main $main): void
    {
        if($main->image){
            $path = str_replace("storage","app/public",$main->image);
            (new FileService)->delete_file($path);
        }
    }

}
