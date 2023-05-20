<?php

namespace App\Modules\Referal\Banners\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Referal\Banners\Requests\BannerCreateRequest;
use App\Modules\Referal\Banners\Services\BannerService;

class BannerCreateController extends Controller
{
    private $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function get(){
        return view('admin.pages.referal.banner.create');
    }

    public function post(BannerCreateRequest $request){
        try {
            //code...
            $banner = $this->bannerService->create(
                $request->except('image'),
            );
            if($request->hasFile('image')){
                $this->bannerService->saveImage($banner);
            }
            return response()->json(["message" => "Banner created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
