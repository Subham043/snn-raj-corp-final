<?php

namespace App\Modules\Awards\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Awards\Services\AwardHeadingService;
use App\Modules\Awards\Services\AwardService;
use Illuminate\Http\Request;

class AwardPaginateController extends Controller
{
    private $awardService;
    private $awardHeadingService;

    public function __construct(AwardService $awardService, AwardHeadingService $awardHeadingService)
    {
        $this->middleware('permission:list awards', ['only' => ['get']]);
        $this->awardService = $awardService;
        $this->awardHeadingService = $awardHeadingService;
    }

    public function get(Request $request){
        $awardHeading = $this->awardHeadingService->getById(1);
        $data = $this->awardService->paginate($request->total ?? 10);
        return view('admin.pages.award.paginate', compact(['data', 'awardHeading']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
