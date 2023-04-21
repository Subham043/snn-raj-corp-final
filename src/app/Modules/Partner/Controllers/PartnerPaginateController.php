<?php

namespace App\Modules\Partner\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Partner\Services\PartnerHeadingService;
use App\Modules\Partner\Services\PartnerService;
use Illuminate\Http\Request;

class PartnerPaginateController extends Controller
{
    private $partnerService;
    private $partnerHeadingService;

    public function __construct(PartnerService $partnerService, PartnerHeadingService $partnerHeadingService)
    {
        $this->middleware('permission:list partners', ['only' => ['get']]);
        $this->partnerService = $partnerService;
        $this->partnerHeadingService = $partnerHeadingService;
    }

    public function get(Request $request){
        $partnerHeading = $this->partnerHeadingService->getById(1);
        $data = $this->partnerService->paginate($request->total ?? 10);
        return view('admin.pages.partner.paginate', compact(['data', 'partnerHeading']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
