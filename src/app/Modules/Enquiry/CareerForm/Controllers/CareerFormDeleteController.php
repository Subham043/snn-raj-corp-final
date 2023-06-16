<?php

namespace App\Modules\Enquiry\CareerForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\CareerForm\Services\CareerFormService;

class CareerFormDeleteController extends Controller
{
    private $careerFormService;

    public function __construct(CareerFormService $careerFormService)
    {
        $this->middleware('permission:delete enquiries', ['only' => ['get']]);
        $this->careerFormService = $careerFormService;
    }

    public function get($id){
        $career = $this->careerFormService->getById($id);

        try {
            //code...
            $this->careerFormService->delete(
                $career
            );
            return redirect()->back()->with('success_status', 'Career Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
