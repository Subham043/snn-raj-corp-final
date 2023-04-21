<?php

namespace App\Modules\TeamMember\Staff\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Staff\Services\StaffHeadingService;
use App\Modules\TeamMember\Staff\Services\StaffService;
use Illuminate\Http\Request;

class StaffPaginateController extends Controller
{
    private $staffService;
    private $staffHeadingService;

    public function __construct(StaffService $staffService, StaffHeadingService $staffHeadingService)
    {
        $this->middleware('permission:list team member staffs', ['only' => ['get']]);
        $this->staffService = $staffService;
        $this->staffHeadingService = $staffHeadingService;
    }

    public function get(Request $request){
        $staffHeading = $this->staffHeadingService->getById(1);
        $data = $this->staffService->paginate($request->total ?? 10);
        return view('admin.pages.team_member.staff.paginate', compact(['data', 'staffHeading']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
