<?php

namespace App\Modules\Enquiry\LandOwnerForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\LandOwnerForm\Services\LandOwnerFormService;
use Illuminate\Http\Request;

class LandOwnerFormPaginateController extends Controller
{
    private $landOwnerFormService;

    public function __construct(LandOwnerFormService $landOwnerFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->landOwnerFormService = $landOwnerFormService;
    }

    public function get(Request $request){
        $data = $this->landOwnerFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.land_owner_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
