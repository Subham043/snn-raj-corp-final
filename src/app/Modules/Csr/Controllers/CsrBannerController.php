<?php

namespace App\Modules\Csr\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Csr\Requests\CsrBannerRequest;
use App\Modules\Csr\Services\CsrBannerService;

class CsrBannerController extends Controller
{
    private $csrBannerService;

    public function __construct(CsrBannerService $csrBannerService)
    {
        $this->middleware('permission:edit csr banner', ['only' => ['get','post']]);
        $this->csrBannerService = $csrBannerService;
    }

    public function get(){
        $data = $this->csrBannerService->getById(1);
        return view('admin.pages.csr.banner', compact('data'));
    }

    public function post(CsrBannerRequest $request){
        try {
            //code...
            $csr_banner = $this->csrBannerService->createOrUpdate(
                $request->except('image'),
            );
            if($request->hasFile('image')){
                $this->csrBannerService->saveImage($csr_banner);
            }
            return response()->json(["message" => "Csr Banner updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
