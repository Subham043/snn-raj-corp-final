<?php

namespace App\Modules\Awards\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Awards\Services\AwardService;
use Illuminate\Http\Request;

class AwardPaginateController extends Controller
{
    private $awardService;

    public function __construct(AwardService $awardService)
    {
        $this->middleware('permission:list awards', ['only' => ['get']]);
        $this->awardService = $awardService;
    }

    public function get(Request $request){
        $data = $this->awardService->paginate($request->total ?? 10);
        return view('admin.pages.award.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
