<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class CampaignFileService
{

    public function save_file(Request $request, String $file_type, String $path): string|null
    {
        if($request->hasFile($file_type)){
            $image = $request[$file_type]->hashName();
            $request[$file_type]->storeAs($path,$image);
            return $image;
        }

        return null;
    }

    public function delete_file(string $path): void
    {
        if(file_exists(storage_path($path))){
            unlink(storage_path($path));
        }
    }

}
