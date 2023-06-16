<?php

namespace App\Modules\Enquiry\CareerForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\CareerForm\Services\CareerFormService;
use Illuminate\Http\Request;

class CareerFormPaginateController extends Controller
{
    private $careerFormService;

    public function __construct(CareerFormService $careerFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->careerFormService = $careerFormService;
    }

    public function get(Request $request){
        $data = $this->careerFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.career_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
