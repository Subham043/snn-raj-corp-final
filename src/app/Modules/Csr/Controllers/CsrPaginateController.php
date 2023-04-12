<?php

namespace App\Modules\Csr\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Csr\Services\CsrService;
use Illuminate\Http\Request;

class CsrPaginateController extends Controller
{
    private $csrService;

    public function __construct(CsrService $csrService)
    {
        $this->middleware('permission:list csr content', ['only' => ['get']]);
        $this->csrService = $csrService;
    }

    public function get(Request $request){
        $data = $this->csrService->paginate($request->total ?? 10);
        return view('admin.pages.csr.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
