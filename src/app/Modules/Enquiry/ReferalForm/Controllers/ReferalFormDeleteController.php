<?php

namespace App\Modules\Enquiry\ReferalForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\ReferalForm\Services\ReferalFormService;

class ReferalFormDeleteController extends Controller
{
    private $referalFormService;

    public function __construct(ReferalFormService $referalFormService)
    {
        $this->middleware('permission:delete enquiries', ['only' => ['get']]);
        $this->referalFormService = $referalFormService;
    }

    public function get($id){
        $referal = $this->referalFormService->getById($id);

        try {
            //code...
            $this->referalFormService->delete(
                $referal
            );
            return redirect()->back()->with('success_status', 'Referal Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
