<?php

namespace App\Modules\Counter\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Counter\Services\CounterHeadingService;
use App\Modules\Counter\Services\CounterService;
use Illuminate\Http\Request;

class CounterPaginateController extends Controller
{
    private $counterService;
    private $counterHeadingService;

    public function __construct(CounterService $counterService, CounterHeadingService $counterHeadingService)
    {
        $this->middleware('permission:list counters', ['only' => ['get']]);
        $this->counterService = $counterService;
        $this->counterHeadingService = $counterHeadingService;
    }

    public function get(Request $request){
        $counterHeading = $this->counterHeadingService->getById(1);
        $data = $this->counterService->paginate($request->total ?? 10);
        return view('admin.pages.counter.paginate', compact(['data', 'counterHeading']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
