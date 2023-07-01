<?php

namespace App\Modules\Enquiry\FreeAdForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\FreeAdForm\Services\FreeAdFormService;
use Illuminate\Http\Request;

class FreeAdFormPaginateController extends Controller
{
    private $freeAdFormService;

    public function __construct(FreeAdFormService $freeAdFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->freeAdFormService = $freeAdFormService;
    }

    public function get(Request $request){
        $data = $this->freeAdFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.free_ad_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
