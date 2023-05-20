<?php

namespace App\Modules\Referal\Banners\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Referal\Banners\Requests\BannerUpdateRequest;
use App\Modules\Referal\Banners\Services\BannerService;

class BannerUpdateController extends Controller
{
    private $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function get($id){
        $data = $this->bannerService->getById($id);
        return view('admin.pages.referal.banner.update', compact('data'));
    }

    public function post(BannerUpdateRequest $request, $id){
        $banner = $this->bannerService->getById($id);
        try {
            //code...
            $this->bannerService->update(
                $request->except('image'),
                $banner
            );
            if($request->hasFile('image')){
                $this->bannerService->saveImage($banner);
            }
            return response()->json(["message" => "Banner updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
