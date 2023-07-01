<?php

namespace App\Modules\Enquiry\FreeAdForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\FreeAdForm\Services\FreeAdFormService;

class FreeAdFormDeleteController extends Controller
{
    private $freeAdFormService;

    public function __construct(FreeAdFormService $freeAdFormService)
    {
        $this->middleware('permission:delete enquiries', ['only' => ['get']]);
        $this->freeAdFormService = $freeAdFormService;
    }

    public function get($id){
        $freeAd = $this->freeAdFormService->getById($id);

        try {
            //code...
            $this->freeAdFormService->delete(
                $freeAd
            );
            return redirect()->back()->with('success_status', 'Free Ad Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
