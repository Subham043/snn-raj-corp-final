<?php

namespace App\Modules\Referal\Banners\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Referal\Banners\Services\BannerService;
use Illuminate\Http\Request;

class BannerPaginateController extends Controller
{
    private $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function get(Request $request){
        $data = $this->bannerService->paginate($request->total ?? 10);
        return view('admin.pages.referal.banner.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
