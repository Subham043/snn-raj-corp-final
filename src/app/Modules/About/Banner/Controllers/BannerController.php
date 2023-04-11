<?php

namespace App\Modules\About\Banner\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\About\Banner\Requests\BannerRequest;
use App\Modules\About\Banner\Services\BannerService;

class BannerController extends Controller
{
    private $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->middleware('permission:edit about banner', ['only' => ['get','post']]);
        $this->bannerService = $bannerService;
    }

    public function get(){
        $data = $this->bannerService->getById(1);
        return view('admin.pages.about.banner', compact('data'));
    }

    public function post(BannerRequest $request){
        try {
            //code...
            $banner = $this->bannerService->createOrUpdate(
                $request->except('image'),
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
