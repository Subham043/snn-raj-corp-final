<?php

namespace App\Modules\Enquiry\LandOwnerForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\LandOwnerForm\Services\LandOwnerFormService;

class LandOwnerFormDeleteController extends Controller
{
    private $landOwnerFormService;

    public function __construct(LandOwnerFormService $landOwnerFormService)
    {
        $this->middleware('permission:delete enquiries', ['only' => ['get']]);
        $this->landOwnerFormService = $landOwnerFormService;
    }

    public function get($id){
        $landOwner = $this->landOwnerFormService->getById($id);

        try {
            //code...
            $this->landOwnerFormService->delete(
                $landOwner
            );
            return redirect()->back()->with('success_status', 'Land Owner Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
