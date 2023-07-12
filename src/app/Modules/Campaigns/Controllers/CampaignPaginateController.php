<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignPaginateController extends Controller
{
    private $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
    }

    public function get(Request $request){
        $data = $this->campaignService->paginate($request, 10);
        return view('admin.pages.campaigns.paginate')->with(
            [
                'data' => $data
            ]
        )->with('search', $request->query('filter')['search'] ?? '');
    }
}
