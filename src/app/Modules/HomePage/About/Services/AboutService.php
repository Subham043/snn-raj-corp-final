<?php

namespace App\Modules\HomePage\About\Services;

use App\Http\Services\FileService;
use App\Modules\HomePage\About\Models\About;
use Illuminate\Support\Facades\Cache;

class AboutService
{

    public function getById(Int $id): About|null
    {
        return Cache::remember('home_page_about_main_'.$id, 60*60*24, function() use($id){
            return About::where('id', $id)->first();
        });
    }

    public function createOrUpdate(array $data): About
    {
        $about = About::updateOrCreate(
            ['id' => 1],
            [...$data]
        );

        $about->user_id = auth()->user()->id;
        $about->save();

        return $about;
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
