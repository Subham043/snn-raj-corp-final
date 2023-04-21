<?php

namespace App\Modules\Main\AwardPage;

use App\Http\Controllers\Controller;
use App\Modules\Awards\Services\AwardHeadingService;
use App\Modules\Awards\Services\AwardService;
use App\Modules\Seo\Services\SeoService;
use Illuminate\Http\Request;

class AwardPageController extends Controller
{
    private $awardService;
    private $awardHeadingService;
    private $seoService;

    public function __construct(
        AwardService $awardService,
        AwardHeadingService $awardHeadingService,
        SeoService $seoService
    )
    {
        $this->awardService = $awardService;
        $this->awardHeadingService = $awardHeadingService;
        $this->seoService = $seoService;
    }

    public function get(Request $request){
        $awards = $this->awardService->main_paginate($request->total ?? 10);
        $awardHeading = $this->awardHeadingService->getById(1);
        $seo = $this->seoService->getBySlugMain('award-page');
        return view('main.pages.award', compact(['awards', 'seo', 'awardHeading']));
    }

}
