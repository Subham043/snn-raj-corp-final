<?php

namespace App\Modules\Enquiry\ReferalForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\ReferalForm\Services\ReferalFormService;
use Illuminate\Http\Request;

class ReferalFormPaginateController extends Controller
{
    private $referalFormService;

    public function __construct(ReferalFormService $referalFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->referalFormService = $referalFormService;
    }

    public function get(Request $request){
        $data = $this->referalFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.referal_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
