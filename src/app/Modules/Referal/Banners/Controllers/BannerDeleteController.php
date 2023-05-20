<?php

namespace App\Modules\Referal\Banners\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Referal\Banners\Services\BannerService;

class BannerDeleteController extends Controller
{
    private $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function get($id){
        $banner = $this->bannerService->getById($id);

        try {
            //code...
            $this->bannerService->delete(
                $banner
            );
            return redirect()->back()->with('success_status', 'Banner deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
