<?php

namespace App\Modules\TeamMember\Management\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Management\Services\ManagementHeadingService;
use App\Modules\TeamMember\Management\Services\ManagementService;
use Illuminate\Http\Request;

class ManagementPaginateController extends Controller
{
    private $managementService;
    private $managementHeadingService;

    public function __construct(ManagementService $managementService, ManagementHeadingService $managementHeadingService)
    {
        $this->middleware('permission:list team member managements', ['only' => ['get']]);
        $this->managementService = $managementService;
        $this->managementHeadingService = $managementHeadingService;
    }

    public function get(Request $request){
        $managementHeading = $this->managementHeadingService->getById(1);
        $data = $this->managementService->paginate($request->total ?? 10);
        return view('admin.pages.team_member.management.paginate', compact(['data', 'managementHeading']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
