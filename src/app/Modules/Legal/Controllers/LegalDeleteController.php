<?php

namespace App\Modules\Legal\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Legal\Services\LegalService;

class LegalDeleteController extends Controller
{
    private $legalService;

    public function __construct(LegalService $legalService)
    {
        $this->middleware('permission:delete legal pages', ['only' => ['get']]);
        $this->legalService = $legalService;
    }

    public function get($id){
        $legal = $this->legalService->getById($id);

        try {
            //code...
            $this->legalService->delete(
                $legal
            );
            return redirect()->back()->with('success_status', 'Legal Pages deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
