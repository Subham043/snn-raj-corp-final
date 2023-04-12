<?php

namespace App\Modules\Csr\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Csr\Requests\CsrCreateRequest;
use App\Modules\Csr\Services\CsrService;

class CsrCreateController extends Controller
{
    private $csrService;

    public function __construct(CsrService $csrService)
    {
        $this->middleware('permission:create csr content', ['only' => ['get','post']]);
        $this->csrService = $csrService;
    }

    public function get(){
        return view('admin.pages.csr.create');
    }

    public function post(CsrCreateRequest $request){

        try {
            //code...
            $csr = $this->csrService->create(
                $request->except('image')
            );
            if($request->image==true && $request->hasFile('image')){
                $this->csrService->saveImage($csr);
            }
            return response()->json(["message" => "Csr created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
