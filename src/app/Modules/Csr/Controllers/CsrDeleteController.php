<?php

namespace App\Modules\Csr\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Csr\Services\CsrService;

class CsrDeleteController extends Controller
{
    private $csrService;

    public function __construct(CsrService $csrService)
    {
        $this->middleware('permission:delete csr content', ['only' => ['get']]);
        $this->csrService = $csrService;
    }

    public function get($id){
        $csr = $this->csrService->getById($id);

        try {
            //code...
            $this->csrService->delete(
                $csr
            );
            return redirect()->back()->with('success_status', 'Csr deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
