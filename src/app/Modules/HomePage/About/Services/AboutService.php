<?php

namespace App\Modules\HomePage\About\Services;

use App\Http\Services\FileService;
use App\Modules\HomePage\About\Models\About;

class AboutService
{

    public function getById(Int $id): About|null
    {
        return About::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): About
    {
        return About::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

    public function saveImage(About $about): About
    {
        $this->deleteImage($about);
        $image = (new FileService)->save_file('image', (new About)->image_path);
        $about->update([
            'image' => $image,
        ]);
        return $about;
    }

    public function deleteImage(About $about): void
    {
        if($about->image){
            $path = str_replace("storage","app/public",$about->image);
            (new FileService)->delete_file($path);
        }
    }

}